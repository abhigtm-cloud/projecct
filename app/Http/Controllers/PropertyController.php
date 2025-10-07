<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Category;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PropertyController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Property::with(['images', 'category', 'host', 'reviews'])
            ->active();

        // Category filter
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price_per_night', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price_per_night', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $properties = $query->paginate(20);
        $categories = Category::active()->ordered()->get();

        return view('nextbnb.properties.index', compact('properties', 'categories'));
    }

        /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        $categories = Category::all();
        return view('nextbnb.properties.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:entire_place,private_room,shared_room',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'guests' => 'required|integer|min:1|max:16',
            'bedrooms' => 'required|integer|min:0|max:20',
            'beds' => 'required|integer|min:1|max:50',
            'bathrooms' => 'required|integer|min:1|max:20',
            'price_per_night' => 'required|numeric|min:1|max:10000',
            'cleaning_fee' => 'nullable|numeric|min:0|max:1000',
            'service_fee' => 'nullable|numeric|min:0|max:1000',
            'amenities' => 'nullable|array',
            'house_rules' => 'nullable|string|max:1000',
            'instant_book' => 'boolean',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['cleaning_fee'] = $validated['cleaning_fee'] ?? 0;
        $validated['service_fee'] = $validated['service_fee'] ?? 0;
        $validated['instant_book'] = $request->boolean('instant_book');

        $property = Property::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imagePath = $image->store('properties/' . $property->id, 'public');
                
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $imagePath,
                    'is_primary' => $index === 0, // First image is primary
                    'sort_order' => $index + 1
                ]);
            }
        }

        return redirect()->route('properties.show', $property)
            ->with('success', 'Property created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $property->load(['images', 'category', 'user', 'reviews.user']);
        
        // Get similar properties
        $similarProperties = Property::with(['images', 'reviews'])
            ->where('category_id', $property->category_id)
            ->where('id', '!=', $property->id)
            ->limit(8)
            ->get();

        return view('nextbnb.properties.show', compact('property', 'similarProperties'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $this->authorize('update', $property);
        $categories = Category::active()->ordered()->get();
        return view('nextbnb.properties.edit', compact('property', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $this->authorize('update', $property);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:entire_place,private_room,shared_room',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'guests' => 'required|integer|min:1|max:16',
            'bedrooms' => 'required|integer|min:0|max:20',
            'beds' => 'required|integer|min:1|max:50',
            'bathrooms' => 'required|integer|min:1|max:20',
            'price_per_night' => 'required|numeric|min:1|max:10000',
            'cleaning_fee' => 'nullable|numeric|min:0|max:1000',
            'service_fee' => 'nullable|numeric|min:0|max:1000',
            'amenities' => 'nullable|array',
            'house_rules' => 'nullable|string|max:1000',
            'instant_book' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $validated['cleaning_fee'] = $validated['cleaning_fee'] ?? 0;
        $validated['service_fee'] = $validated['service_fee'] ?? 0;
        $validated['instant_book'] = $request->boolean('instant_book');
        $validated['is_active'] = $request->boolean('is_active', true);

        $property->update($validated);

        // Handle new image uploads
        if ($request->hasFile('new_images')) {
            $lastSortOrder = $property->images()->max('sort_order') ?? 0;
            
            foreach ($request->file('new_images') as $index => $image) {
                $imagePath = $image->store('properties/' . $property->id, 'public');
                
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $imagePath,
                    'is_primary' => false,
                    'sort_order' => $lastSortOrder + $index + 1
                ]);
            }
        }

        return redirect()->route('properties.show', $property)
            ->with('success', 'Property updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);

        // Delete property images from storage
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $property->delete();

        return redirect()->route('host.properties')
            ->with('success', 'Property deleted successfully!');
    }

    /**
     * Search properties
     */
    public function search(Request $request)
    {
        $query = Property::with(['images', 'category', 'host', 'reviews'])->active();

        // Location search
        if ($request->filled('location')) {
            $location = $request->location;
            $query->where(function($q) use ($location) {
                $q->where('city', 'like', "%{$location}%")
                  ->orWhere('country', 'like', "%{$location}%")
                  ->orWhere('address', 'like', "%{$location}%");
            });
        }

        // Date availability (basic implementation)
        if ($request->filled('check_in') && $request->filled('check_out')) {
            // This would need more complex availability checking
            // For now, we'll just filter out properties with overlapping bookings
        }

        // Guest capacity
        if ($request->filled('guests')) {
            $query->where('guests', '>=', $request->guests);
        }

        // Price range
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->min_price ?? 0;
            $maxPrice = $request->max_price ?? 10000;
            $query->whereBetween('price_per_night', [$minPrice, $maxPrice]);
        }

        // Property type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Amenities filter
        if ($request->filled('amenities')) {
            $amenities = $request->amenities;
            $query->where(function($q) use ($amenities) {
                foreach ($amenities as $amenity) {
                    $q->whereJsonContains('amenities', $amenity);
                }
            });
        }

        $properties = $query->paginate(20)->appends($request->all());
        $categories = Category::active()->ordered()->get();

        return view('nextbnb.properties.search', compact('properties', 'categories'));
    }

    /**
     * Show properties by category
     */
    public function byCategory(Category $category)
    {
        $properties = Property::with(['images', 'host', 'reviews'])
            ->where('category_id', $category->id)
            ->active()
            ->paginate(20);

        $categories = Category::active()->ordered()->get();

        return view('nextbnb.properties.category', compact('properties', 'category', 'categories'));
    }

    /**
     * Host dashboard
     */
    public function hostDashboard()
    {
        $user = Auth::user();
        $properties = $user->properties()->withCount('bookings', 'reviews')->get();
        $totalEarnings = $user->totalEarnings();
        $activeBookings = $user->properties()
            ->with('bookings')
            ->get()
            ->pluck('bookings')
            ->flatten()
            ->where('status', 'confirmed')
            ->count();

        return view('nextbnb.host.dashboard', compact('properties', 'totalEarnings', 'activeBookings'));
    }

    /**
     * Host properties
     */
    public function hostProperties()
    {
        $properties = Auth::user()->properties()
            ->withCount('bookings', 'reviews')
            ->with('images')
            ->paginate(10);

        return view('nextbnb.host.properties', compact('properties'));
    }

    /**
     * Check property availability
     */
    public function checkAvailability(Request $request, Property $property)
    {
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in'
        ]);

        $isAvailable = $property->isAvailable($request->check_in, $request->check_out);

        return response()->json([
            'available' => $isAvailable,
            'message' => $isAvailable ? 'Property is available' : 'Property is not available for selected dates'
        ]);
    }

    /**
     * Get search suggestions
     */
    public function searchSuggestions(Request $request)
    {
        $query = $request->get('query');
        
        if (!$query) {
            return response()->json([]);
        }

        $suggestions = Property::select('city', 'country')
            ->where('city', 'like', "%{$query}%")
            ->orWhere('country', 'like', "%{$query}%")
            ->distinct()
            ->limit(5)
            ->get()
            ->map(function($property) {
                return [
                    'text' => "{$property->city}, {$property->country}",
                    'city' => $property->city,
                    'country' => $property->country
                ];
            });

        return response()->json($suggestions);
    }
}
