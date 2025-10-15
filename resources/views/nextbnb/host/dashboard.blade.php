@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('nextbnb.layouts.app')

@section('title', 'Host Dashboard - NextBNB')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ Auth::user()->first_name ?? Auth::user()->name }}!</h1>
                    <p class="mt-2 text-gray-600">Here's what's happening with your NextBNB listings</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('properties.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New Listing
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Properties -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Properties</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $properties->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Active Bookings -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active Bookings</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $activeBookings }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Earnings -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Earnings</p>
                        <p class="text-2xl font-bold text-gray-900">${{ number_format($totalEarnings, 0) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('properties.create') }}" 
                       class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Add Listing</p>
                            <p class="text-sm text-gray-500">Create new property</p>
                        </div>
                    </a>

                    <a href="{{ route('host.properties') }}" 
                       class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">Manage Properties</p>
                            <p class="text-sm text-gray-500">Edit your listings</p>
                        </div>
                    </a>

                    <a href="{{ route('bookings.index') }}" 
                       class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">View Bookings</p>
                            <p class="text-sm text-gray-500">Manage reservations</p>
                        </div>
                    </a>

                    <a href="{{ route('home') }}" 
                       class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">View as Guest</p>
                            <p class="text-sm text-gray-500">See your listings</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Properties -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Your Properties</h2>
                    <a href="{{ route('host.properties') }}" 
                       class="text-red-600 hover:text-red-700 font-medium text-sm">View All</a>
                </div>
            </div>

            @if($properties->count() > 0)
                <div class="p-6">
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($properties->take(6) as $property)
                            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                <!-- Property Image -->
                                <div class="aspect-w-16 aspect-h-10 bg-gray-200">
                                    @if($property->images->count() > 0)
                                        <img src="{{ Storage::url($property->images->first()->image_path) }}" 
                                             alt="{{ $property->title }}"
                                             class="w-full h-32 object-cover">
                                    @else
                                        <div class="w-full h-32 bg-gray-300 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Property Info -->
                                <div class="p-4">
                                    <div class="flex items-start justify-between mb-2">
                                        <h3 class="text-sm font-semibold text-gray-900 line-clamp-1">{{ $property->title }}</h3>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                                   {{ $property->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $property->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>

                                    <p class="text-xs text-gray-600 mb-2">
                                        {{ $property->city }}, {{ $property->country }}
                                    </p>

                                    <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                        <span>{{ $property->bookings_count }} booking{{ $property->bookings_count !== 1 ? 's' : '' }}</span>
                                        <span>{{ $property->reviews_count }} review{{ $property->reviews_count !== 1 ? 's' : '' }}</span>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-semibold text-gray-900">
                                            ${{ number_format($property->price_per_night, 0) }} / night
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="mt-3 flex space-x-2">
                                        <a href="{{ route('properties.show', $property) }}" 
                                           class="flex-1 px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded text-center transition-colors">
                                            View
                                        </a>
                                        @can('update', $property)
                                            <a href="{{ route('properties.edit', $property) }}" 
                                               class="flex-1 px-2 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded text-center transition-colors">
                                                Edit
                                            </a>
                                        @else
                                            <span class="flex-1 px-2 py-1 bg-gray-400 text-gray-200 text-xs font-medium rounded text-center cursor-not-allowed">
                                                Edit
                                            </span>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($properties->count() > 6)
                        <div class="mt-6 text-center">
                            <a href="{{ route('host.properties') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                View All {{ $properties->count() }} Properties
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <!-- Empty State -->
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No properties yet</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating your first property listing.</p>
                    <div class="mt-6">
                        <a href="{{ route('properties.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create Your First Listing
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection