<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured properties
        $featuredProperties = Property::with(['images', 'category', 'reviews'])
            ->active()
            ->featured()
            ->limit(12)
            ->get();

        // If no featured properties, get recent ones
        if ($featuredProperties->isEmpty()) {
            $featuredProperties = Property::with(['images', 'category', 'reviews'])
                ->active()
                ->latest()
                ->limit(12)
                ->get();
        }

        // Get all categories for filters
        $categories = Category::active()->ordered()->get();

        return view('nextbnb.home', compact('featuredProperties', 'categories'));
    }

    public function search(Request $request)
    {
        $query = Property::with(['images', 'category', 'host', 'reviews'])
            ->active();

        // Location filter
        if ($request->filled('location')) {
            $location = $request->location;
            $query->where(function($q) use ($location) {
                $q->where('city', 'like', "%{$location}%")
                  ->orWhere('country', 'like', "%{$location}%")
                  ->orWhere('address', 'like', "%{$location}%")
                  ->orWhere('title', 'like', "%{$location}%");
            });
        }

        // Guests filter
        if ($request->filled('guests')) {
            $query->where('guests', '>=', $request->guests);
        }

        // Date availability filter (if check_in and check_out are provided)
        if ($request->filled('check_in') && $request->filled('check_out')) {
            $checkIn = $request->check_in;
            $checkOut = $request->check_out;
            
            $query->whereDoesntHave('bookings', function($q) use ($checkIn, $checkOut) {
                $q->where('status', '!=', 'cancelled')
                  ->where(function($query) use ($checkIn, $checkOut) {
                      $query->whereBetween('check_in', [$checkIn, $checkOut])
                            ->orWhereBetween('check_out', [$checkIn, $checkOut])
                            ->orWhere(function($q) use ($checkIn, $checkOut) {
                                $q->where('check_in', '<=', $checkIn)
                                  ->where('check_out', '>=', $checkOut);
                            });
                  });
            });
        }

        // Get search results
        $properties = $query->orderBy('created_at', 'desc')->paginate(20);
        $categories = Category::active()->ordered()->get();

        // Determine the view based on the request
        if ($request->ajax()) {
            return response()->json([
                'html' => view('nextbnb.partials.properties-grid', compact('properties'))->render(),
                'total' => $properties->total()
            ]);
        }

        return view('nextbnb.properties.index', compact('properties', 'categories'));
    }
}
