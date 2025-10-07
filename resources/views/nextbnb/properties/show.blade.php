@extends('nextbnb.layouts.app')

@section('title', $property->title . ' - NextBNB')

@section('content')
<div class="property-detail-container">
    <!-- Property Header -->
    <div class="property-header">
        <h1 class="property-title">{{ $property->title }}</h1>
        <div class="property-meta">
            <div class="property-rating">
                @if($property->reviews && $property->reviews->count() > 0)
                    <span class="rating-stars">★</span>
                    <span class="rating-value">{{ number_format($property->reviews->avg('rating'), 1) }}</span>
                    <span class="rating-count">({{ $property->reviews->count() }} reviews)</span>
                    <span class="separator">·</span>
                @endif
                <span class="property-location">{{ $property->city }}, {{ $property->country }}</span>
            </div>
            <div class="property-actions">
                <button class="action-btn">
                    <svg width="16" height="16" viewBox="0 0 16 16">
                        <path d="M8 1l2.36 4.78L15 6.62l-3.5 3.41L12.72 15 8 12.77 3.28 15l1.22-4.97L1 6.62l4.64-.84L8 1z"/>
                    </svg>
                    Share
                </button>
                <button class="action-btn wishlist-btn" data-property-id="{{ $property->id }}">
                    <svg width="16" height="16" viewBox="0 0 16 16">
                        <path d="M8 14s-6-4.33-6-8a4 4 0 0 1 8 0 4 4 0 0 1 8 0c0 3.67-6 8-6 8z"/>
                    </svg>
                    Save
                </button>
            </div>
        </div>
    </div>

    <!-- Property Images -->
    <div class="property-images">
        @if($property->images && $property->images->count() > 0)
            <div class="images-grid">
                <div class="main-image">
                    <img src="{{ Storage::url($property->images->first()->image_path) }}" 
                         alt="{{ $property->title }}" 
                         class="main-img">
                </div>
                @if($property->images->count() > 1)
                    <div class="side-images">
                        @foreach($property->images->skip(1)->take(4) as $image)
                            <div class="side-image">
                                <img src="{{ Storage::url($image->image_path) }}" 
                                     alt="{{ $property->title }}" 
                                     class="side-img">
                            </div>
                        @endforeach
                    </div>
                @endif
                @if($property->images->count() > 5)
                    <button class="show-all-photos-btn">
                        <svg width="16" height="16" viewBox="0 0 16 16">
                            <path d="M6 2h8v8M2 6h8v8"/>
                        </svg>
                        Show all {{ $property->images->count() }} photos
                    </button>
                @endif
            </div>
        @else
            <div class="no-images">
                <div class="no-images-placeholder">
                    <svg width="48" height="48" viewBox="0 0 24 24">
                        <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                    </svg>
                    <p>No photos available</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Property Content -->
    <div class="property-content">
        <div class="content-main">
            <!-- Property Info -->
            <div class="property-info">
                <div class="host-info">
                    <div class="host-avatar">
                        <img src="https://via.placeholder.com/56x56/ff385c/ffffff?text={{ substr($property->user->name, 0, 1) }}" 
                             alt="{{ $property->user->name }}" 
                             class="host-img">
                    </div>
                    <div class="host-details">
                        <h2>{{ ucfirst(str_replace('_', ' ', $property->type)) }} hosted by {{ $property->user->name }}</h2>
                        <div class="property-specs">
                            <span>{{ $property->guests }} guests</span>
                            <span>·</span>
                            <span>{{ $property->bedrooms }} bedrooms</span>
                            <span>·</span>
                            <span>{{ $property->beds }} beds</span>
                            <span>·</span>
                            <span>{{ $property->bathrooms }} bathrooms</span>
                        </div>
                    </div>
                </div>

                <div class="property-highlights">
                    <div class="highlight-item">
                        <div class="highlight-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div class="highlight-content">
                            <h3>Highly rated</h3>
                            <p>{{ $property->user->name }} is a Superhost with excellent reviews</p>
                        </div>
                    </div>

                    @if($property->amenities && in_array('self_check_in', $property->amenities))
                    <div class="highlight-item">
                        <div class="highlight-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zM15.1 8H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                            </svg>
                        </div>
                        <div class="highlight-content">
                            <h3>Self check-in</h3>
                            <p>Check yourself in with the lockbox</p>
                        </div>
                    </div>
                    @endif

                    <div class="highlight-item">
                        <div class="highlight-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <div class="highlight-content">
                            <h3>Great location</h3>
                            <p>Perfect spot in {{ $property->city }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Description -->
            <div class="property-description">
                <p>{{ $property->description }}</p>
            </div>

            <!-- Amenities -->
            @if($property->amenities)
            <div class="amenities-section">
                <h2>What this place offers</h2>
                <div class="amenities-list">
                    @php
                        $amenities = $property->amenities ?: [];
                        $amenityLabels = [
                            'wifi' => 'Wi-Fi',
                            'tv' => 'TV',
                            'kitchen' => 'Kitchen',
                            'washer' => 'Washer',
                            'dryer' => 'Dryer',
                            'air_conditioning' => 'Air conditioning',
                            'heating' => 'Heating',
                            'workspace' => 'Dedicated workspace',
                            'pool' => 'Pool',
                            'hot_tub' => 'Hot tub',
                            'patio' => 'Patio or balcony',
                            'bbq_grill' => 'BBQ grill',
                            'fire_pit' => 'Fire pit',
                            'pool_table' => 'Pool table',
                            'gym' => 'Exercise equipment',
                            'beach_access' => 'Beach access',
                            'ski_in_out' => 'Ski-in/ski-out',
                            'parking' => 'Free parking',
                            'ev_charger' => 'EV charger',
                            'crib' => 'Crib',
                            'high_chair' => 'High chair',
                            'smoke_alarm' => 'Smoke alarm',
                            'carbon_monoxide' => 'Carbon monoxide alarm',
                            'first_aid' => 'First aid kit',
                            'fire_extinguisher' => 'Fire extinguisher',
                            'self_check_in' => 'Self check-in',
                            'pets_allowed' => 'Pets allowed',
                            'smoking_allowed' => 'Smoking allowed',
                        ];
                    @endphp

                    @foreach($amenities as $amenity)
                        @if(isset($amenityLabels[$amenity]))
                        <div class="amenity-item">
                            <svg width="24" height="24" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                            <span>{{ $amenityLabels[$amenity] }}</span>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Booking Card -->
        <div class="booking-card">
            <div class="booking-header">
                <div class="price-info">
                    <span class="price">${{ number_format($property->price_per_night) }}</span>
                    <span class="price-period">night</span>
                </div>
                @if($property->reviews && $property->reviews->count() > 0)
                <div class="booking-rating">
                    <span class="rating-stars">★</span>
                    <span class="rating-value">{{ number_format($property->reviews->avg('rating'), 1) }}</span>
                    <span class="rating-count">({{ $property->reviews->count() }})</span>
                </div>
                @endif
            </div>

            <form action="{{ route('bookings.store') }}" method="POST" class="booking-form">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                
                <div class="date-inputs">
                    <div class="date-input">
                        <label>CHECK-IN</label>
                        <input type="date" 
                               name="check_in" 
                               id="check_in" 
                               class="form-control"
                               min="{{ date('Y-m-d') }}"
                               required>
                    </div>
                    <div class="date-input">
                        <label>CHECK-OUT</label>
                        <input type="date" 
                               name="check_out" 
                               id="check_out" 
                               class="form-control"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               required>
                    </div>
                </div>

                <div class="guests-input">
                    <label>GUESTS</label>
                    <select name="guests" class="form-control" required>
                        @for($i = 1; $i <= $property->guests; $i++)
                            <option value="{{ $i }}">{{ $i }} guest{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>

                <div class="booking-summary" id="booking-summary" style="display: none;">
                    <div class="summary-row">
                        <span>${{ number_format($property->price_per_night) }} x <span id="nights">0</span> nights</span>
                        <span id="subtotal">$0</span>
                    </div>
                    @if($property->cleaning_fee > 0)
                    <div class="summary-row">
                        <span>Cleaning fee</span>
                        <span>${{ number_format($property->cleaning_fee) }}</span>
                    </div>
                    @endif
                    @if($property->service_fee > 0)
                    <div class="summary-row">
                        <span>Service fee</span>
                        <span>${{ number_format($property->service_fee) }}</span>
                    </div>
                    @endif
                    <hr>
                    <div class="summary-row total">
                        <span><strong>Total</strong></span>
                        <span><strong id="total">$0</strong></span>
                    </div>
                </div>

                <button type="submit" class="btn-reserve" id="reserve-btn">
                    Check availability
                </button>
            </form>

            <p class="booking-note">You won't be charged yet</p>
        </div>
    </div>

    <!-- Reviews Section -->
    @if($property->reviews && $property->reviews->count() > 0)
    <div class="reviews-section">
        <h2>
            <span class="rating-stars">★</span>
            {{ number_format($property->reviews->avg('rating'), 1) }} · {{ $property->reviews->count() }} reviews
        </h2>
        
        <div class="reviews-grid">
            @foreach($property->reviews->take(6) as $review)
            <div class="review-item">
                <div class="review-header">
                    <div class="reviewer-avatar">
                        <img src="https://via.placeholder.com/40x40/717171/ffffff?text={{ substr($review->user->name, 0, 1) }}" 
                             alt="{{ $review->user->name }}" 
                             class="reviewer-img">
                    </div>
                    <div class="reviewer-info">
                        <h4>{{ $review->user->name }}</h4>
                        <p class="review-date">{{ $review->created_at->format('F Y') }}</p>
                    </div>
                </div>
                <div class="review-content">
                    <p>{{ Str::limit($review->comment, 150) }}</p>
                </div>
            </div>
            @endforeach
        </div>

        @if($property->reviews->count() > 6)
        <button class="show-all-reviews-btn">
            Show all {{ $property->reviews->count() }} reviews
        </button>
        @endif
    </div>
    @endif

    <!-- House Rules -->
    @if($property->house_rules)
    <div class="house-rules-section">
        <h2>House rules</h2>
        <div class="house-rules-content">
            <p>{{ $property->house_rules }}</p>
        </div>
    </div>
    @endif

    <!-- Location -->
    <div class="location-section">
        <h2>Where you'll be</h2>
        <div class="location-info">
            <h3>{{ $property->city }}, {{ $property->country }}</h3>
            <div class="location-map">
                <!-- Placeholder for map -->
                <div class="map-placeholder">
                    <svg width="48" height="48" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    <p>Map showing {{ $property->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Booking calculation
document.addEventListener('DOMContentLoaded', function() {
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const bookingSummary = document.getElementById('booking-summary');
    const reserveBtn = document.getElementById('reserve-btn');
    const nightsSpan = document.getElementById('nights');
    const subtotalSpan = document.getElementById('subtotal');
    const totalSpan = document.getElementById('total');

    const pricePerNight = {{ $property->price_per_night }};
    const cleaningFee = {{ $property->cleaning_fee ?? 0 }};
    const serviceFee = {{ $property->service_fee ?? 0 }};

    function calculateTotal() {
        const checkIn = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);
        
        if (checkInInput.value && checkOutInput.value && checkOut > checkIn) {
            const timeDiff = checkOut.getTime() - checkIn.getTime();
            const nights = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            const subtotal = pricePerNight * nights;
            const total = subtotal + cleaningFee + serviceFee;
            
            nightsSpan.textContent = nights;
            subtotalSpan.textContent = '$' + subtotal.toLocaleString();
            totalSpan.textContent = '$' + total.toLocaleString();
            
            bookingSummary.style.display = 'block';
            reserveBtn.textContent = 'Reserve';
        } else {
            bookingSummary.style.display = 'none';
            reserveBtn.textContent = 'Check availability';
        }
    }

    checkInInput.addEventListener('change', function() {
        // Set minimum checkout date to one day after checkin
        const checkInDate = new Date(this.value);
        checkInDate.setDate(checkInDate.getDate() + 1);
        checkOutInput.min = checkInDate.toISOString().split('T')[0];
        calculateTotal();
    });

    checkOutInput.addEventListener('change', calculateTotal);

    // Wishlist functionality
    const wishlistBtn = document.querySelector('.wishlist-btn');
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function() {
            const propertyId = this.dataset.propertyId;
            
            fetch('/api/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    property_id: propertyId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update button appearance based on wishlist status
                    this.classList.toggle('active', data.in_wishlist);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
</script>
@endsection