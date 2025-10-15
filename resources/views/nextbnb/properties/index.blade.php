@extends('nextbnb.layouts.app')

@section('title', 'All Properties - NextBNB')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-900 sm:text-5xl">
                    Find your perfect stay
                </h1>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                    Discover unique homes, apartments, and experiences around the world
                </p>
            </div>

            <!-- Search Bar -->
            <div class="mt-8 max-w-4xl mx-auto">
                <form action="{{ route('search') }}" method="GET" class="bg-white rounded-lg shadow-lg border border-gray-200 p-2">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
                        <!-- Location -->
                        <div class="relative">
                            <input type="text" 
                                   name="location" 
                                   placeholder="Where are you going?"
                                   value="{{ request('location') }}"
                                   class="w-full px-4 py-3 border-0 focus:ring-2 focus:ring-red-500 rounded-lg">
                        </div>

                        <!-- Check-in -->
                        <div class="relative">
                            <input type="date" 
                                   name="check_in" 
                                   value="{{ request('check_in') }}"
                                   class="w-full px-4 py-3 border-0 focus:ring-2 focus:ring-red-500 rounded-lg">
                        </div>

                        <!-- Check-out -->
                        <div class="relative">
                            <input type="date" 
                                   name="check_out" 
                                   value="{{ request('check_out') }}"
                                   class="w-full px-4 py-3 border-0 focus:ring-2 focus:ring-red-500 rounded-lg">
                        </div>

                        <!-- Search Button -->
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition-colors flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Categories -->
        @if($categories->count() > 0)
        <div class="mb-8">
            <div class="flex items-center space-x-4 overflow-x-auto pb-4">
                <a href="{{ route('properties.index') }}" 
                   class="flex-shrink-0 px-4 py-2 rounded-full border {{ !request('category') ? 'bg-red-600 text-white border-red-600' : 'bg-white text-gray-700 border-gray-300 hover:border-gray-400' }} transition-colors">
                    All Properties
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('properties.index', ['category' => $category->slug]) }}" 
                       class="flex-shrink-0 px-4 py-2 rounded-full border {{ request('category') == $category->slug ? 'bg-red-600 text-white border-red-600' : 'bg-white text-gray-700 border-gray-300 hover:border-gray-400' }} transition-colors whitespace-nowrap">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Results Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    @if(request('category'))
                        {{ $categories->where('slug', request('category'))->first()->name ?? 'Properties' }}
                    @else
                        All Properties
                    @endif
                </h2>
                <p class="text-gray-600 mt-1">{{ $properties->total() }} properties found</p>
            </div>

            <!-- Sort Options -->
            <div class="relative">
                <select name="sort" 
                        onchange="location = this.value" 
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'rating']) }}" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                </select>
            </div>
        </div>

        <!-- Properties Grid -->
        @if($properties->count() > 0)
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($properties as $property)
                    <a href="{{ route('properties.show', $property) }}" class="block">
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 hover:shadow-lg transition-shadow group cursor-pointer">
                            <!-- Property Image -->
                            <div class="relative aspect-w-16 aspect-h-12">
                                @if($property->images->count() > 0)
                                    <img src="{{ Storage::url($property->images->first()->image_path) }}" 
                                         alt="{{ $property->title }}"
                                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Wishlist Button -->
                                <button onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist({{ $property->id }})" 
                                        class="absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:shadow-lg transition-shadow z-10">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>

                                <!-- Featured Badge -->
                                @if($property->is_featured)
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-red-600 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                            Featured
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Property Details -->
                            <div class="p-4">
                                <!-- Location & Host -->
                                <div class="flex items-center justify-between mb-2">
                                    <p class="text-sm text-gray-600 truncate">
                                        {{ $property->city }}, {{ $property->country }}
                                    </p>
                                    @if($property->reviews->count() > 0)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span class="ml-1 text-sm text-gray-700">{{ number_format($property->rating, 1) }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Title -->
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-red-600 transition-colors">
                                    {{ $property->title }}
                                </h3>

                                <!-- Property Details -->
                                <div class="flex items-center text-sm text-gray-500 mb-3 space-x-4">
                                    <span>{{ $property->guests }} guest{{ $property->guests > 1 ? 's' : '' }}</span>
                                    <span>{{ $property->bedrooms }} bedroom{{ $property->bedrooms > 1 ? 's' : '' }}</span>
                                    <span>{{ $property->bathrooms }} bath{{ $property->bathrooms > 1 ? 's' : '' }}</span>
                                </div>

                                <!-- Price -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-lg font-bold text-gray-900">${{ number_format($property->price_per_night, 0) }}</span>
                                        <span class="text-sm text-gray-500"> / night</span>
                                    </div>
                                    @if($property->instant_book)
                                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full font-medium">
                                            Instant Book
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $properties->withQueryString()->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No properties found</h3>
                <p class="mt-2 text-gray-500">
                    @if(request('category'))
                        No properties found in this category. Try browsing other categories or clear your filters.
                    @else
                        There are currently no properties available. Check back later for new listings!
                    @endif
                </p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                        Back to Home
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
// Wishlist functionality
function toggleWishlist(propertyId) {
    // Add your wishlist AJAX logic here
    console.log('Toggle wishlist for property:', propertyId);
    
    // Prevent the event from bubbling up to the parent link
    return false;
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('Properties page loaded successfully');
});
</script>
@endsection