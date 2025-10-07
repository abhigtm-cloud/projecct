@extends('nextbnb.layouts.app')

@section('title', 'List Your Property - NextBNB')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">List your space on NextBNB</h1>
            <p class="mt-3 text-lg text-gray-600">Share your home and earn extra income by hosting travelers</p>
        </div>

        <!-- Quick Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <!-- Basic Information -->
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Property Details</h2>
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Property Title *</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('title') border-red-500 @enderror"
                               placeholder="e.g., Cozy downtown apartment"
                               value="{{ old('title') }}"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('description') border-red-500 @enderror"
                                  placeholder="Describe your space, what makes it special, and what guests can expect..."
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Property Type *</label>
                            <select id="category_id" 
                                    name="category_id" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('category_id') border-red-500 @enderror"
                                    required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Listing Type *</label>
                            <select id="type" 
                                    name="type" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('type') border-red-500 @enderror"
                                    required>
                                <option value="">Select type</option>
                                <option value="entire_place" {{ old('type') == 'entire_place' ? 'selected' : '' }}>Entire place</option>
                                <option value="private_room" {{ old('type') == 'private_room' ? 'selected' : '' }}>Private room</option>
                                <option value="shared_room" {{ old('type') == 'shared_room' ? 'selected' : '' }}>Shared room</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Location</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                            <input type="text" 
                                   id="country" 
                                   name="country" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('country') border-red-500 @enderror"
                                   placeholder="e.g., United States"
                                   value="{{ old('country') }}"
                                   required>
                            @error('country')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                            <input type="text" 
                                   id="city" 
                                   name="city" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('city') border-red-500 @enderror"
                                   placeholder="e.g., New York"
                                   value="{{ old('city') }}"
                                   required>
                            @error('city')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                        <input type="text" 
                               id="address" 
                               name="address" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('address') border-red-500 @enderror"
                               placeholder="e.g., 123 Main Street, Apartment 4B"
                               value="{{ old('address') }}"
                               required>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Property Setup -->
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Property Setup</h2>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <label for="guests" class="block text-sm font-medium text-gray-700 mb-2">Guests *</label>
                            <select id="guests" 
                                    name="guests" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('guests') border-red-500 @enderror"
                                    required>
                                @for($i = 1; $i <= 16; $i++)
                                    <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('guests')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-2">Bedrooms *</label>
                            <select id="bedrooms" 
                                    name="bedrooms" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('bedrooms') border-red-500 @enderror"
                                    required>
                                @for($i = 0; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('bedrooms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="beds" class="block text-sm font-medium text-gray-700 mb-2">Beds *</label>
                            <select id="beds" 
                                    name="beds" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('beds') border-red-500 @enderror"
                                    required>
                                @for($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ old('beds') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('beds')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-2">Bathrooms *</label>
                            <select id="bathrooms" 
                                    name="bathrooms" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('bathrooms') border-red-500 @enderror"
                                    required>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('bathrooms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Pricing</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="price_per_night" class="block text-sm font-medium text-gray-700 mb-2">Price per night ($) *</label>
                            <input type="number" 
                                   id="price_per_night" 
                                   name="price_per_night" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('price_per_night') border-red-500 @enderror"
                                   placeholder="100"
                                   value="{{ old('price_per_night') }}"
                                   min="1"
                                   max="10000"
                                   required>
                            @error('price_per_night')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="cleaning_fee" class="block text-sm font-medium text-gray-700 mb-2">Cleaning fee ($)</label>
                            <input type="number" 
                                   id="cleaning_fee" 
                                   name="cleaning_fee" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('cleaning_fee') border-red-500 @enderror"
                                   placeholder="25"
                                   value="{{ old('cleaning_fee') }}"
                                   min="0"
                                   max="1000">
                            @error('cleaning_fee')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="service_fee" class="block text-sm font-medium text-gray-700 mb-2">Service fee ($)</label>
                            <input type="number" 
                                   id="service_fee" 
                                   name="service_fee" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('service_fee') border-red-500 @enderror"
                                   placeholder="15"
                                   value="{{ old('service_fee') }}"
                                   min="0"
                                   max="1000">
                            @error('service_fee')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Amenities (Simplified) -->
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Popular Amenities</h2>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @php
                            $popularAmenities = [
                                'wifi' => 'Wi-Fi',
                                'kitchen' => 'Kitchen', 
                                'parking' => 'Free parking',
                                'air_conditioning' => 'Air conditioning',
                                'tv' => 'TV',
                                'washer' => 'Washer',
                                'pool' => 'Pool',
                                'hot_tub' => 'Hot tub',
                                'workspace' => 'Workspace',
                            ];
                        @endphp

                        @foreach($popularAmenities as $key => $label)
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" 
                                       name="amenities[]" 
                                       value="{{ $key }}"
                                       class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                                       {{ is_array(old('amenities')) && in_array($key, old('amenities')) ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    
                    <p class="text-sm text-gray-500">You can add more amenities after creating your listing</p>
                </div>

                <!-- Photos -->
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-900 border-b border-gray-200 pb-3">Photos</h2>
                    
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Property Photos *</label>
                        <input type="file" 
                               id="images" 
                               name="images[]" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('images.*') border-red-500 @enderror"
                               multiple
                               accept="image/*"
                               required>
                        @error('images.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">
                            Upload at least 3 high-quality photos. The first photo will be your main photo.
                        </p>
                    </div>

                    <div id="image-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                </div>

                <!-- Instant Booking Option -->
                <div class="space-y-6">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" 
                                   id="instant_book" 
                                   name="instant_book" 
                                   value="1"
                                   class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500 mt-1"
                                   {{ old('instant_book') ? 'checked' : '' }}>
                            <div>
                                <span class="font-medium text-gray-900">Allow instant booking</span>
                                <p class="text-sm text-gray-600">Guests can book your place without waiting for approval</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition-colors text-lg">
                        List Your Property
                    </button>
                    <p class="mt-3 text-center text-sm text-gray-500">
                        By clicking "List Your Property", you agree to NextBNB's hosting terms and conditions.
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Image preview functionality
document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    
    const files = Array.from(e.target.files);
    
    files.forEach((file, index) => {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `
                    <img src="${e.target.result}" 
                         alt="Preview ${index + 1}"
                         class="w-full h-24 object-cover rounded-lg border border-gray-200">
                    ${index === 0 ? '<div class="absolute top-2 left-2 bg-red-600 text-white text-xs px-2 py-1 rounded">Main</div>' : ''}
                `;
                preview.appendChild(div);
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection