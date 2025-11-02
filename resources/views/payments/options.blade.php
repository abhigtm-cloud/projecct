@extends('nextbnb.layouts.app')

@section('title', 'Payment options - ' . ($property->title ?? ''))

@section('content')
<div class="container">
    <div class="payments-hero">
        <div class="hero-left">
            <div class="hero-title">Secure checkout</div>
            <div class="hero-sub">Choose how you'd like to pay for <strong>{{ $property->title }}</strong></div>
        </div>
        <div class="hero-right">
            <div class="method-badge">Only cash available</div>
        </div>
    </div>

    <div class="payment-card">
        <p class="price">${{ number_format($property->price_per_night) }} <span style="font-weight:600; color:#64748B; font-size:13px;">/ night</span></p>
        <p class="muted">{{ $property->city }}, {{ $property->country }}</p>
    </div>

    <h2 style="margin-top:12px; margin-bottom:8px">Choose a payment method</h2>
    <div class="payment-methods">

        <div class="payment-overlay">
            <form method="POST" action="{{ route('payments.cash') }}" class="payment-method" aria-label="Cash at homestay">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                <div class="method-icon" aria-hidden="true">
                    <!-- cash icon -->
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="6" width="20" height="12" rx="2" stroke="#0F172A" stroke-width="1.2" fill="#FEF3F4"/>
                        <path d="M12 9a3 3 0 100 6 3 3 0 000-6z" stroke="#0F172A" stroke-width="1.2" fill="#FFF"/>
                    </svg>
                </div>
                <div class="method-info">
                    <div class="method-title">Cash at homestay</div>
                    <div class="method-desc">Pay with cash when you arrive. No online transaction.</div>
                </div>
                <div style="display:flex;align-items:center;gap:10px">
                    <button type="submit" class="btn-primary">Pay with cash</button>
                </div>
            </form>
        </div>

        <div class="payment-method unavailable" aria-disabled="true">
            <div class="method-icon">
                <!-- card icon -->
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="5" width="20" height="14" rx="2" stroke="#94A3B8" stroke-width="1.2" fill="#F8FAFC"/>
                    <path d="M3 9h18" stroke="#CBD5E1" stroke-width="1.2"/>
                </svg>
            </div>
            <div class="method-info">
                <div class="method-title">Credit / Debit Card</div>
                <div class="method-desc">Pay securely online using card.</div>
            </div>
            <div>
                <div class="method-badge" style="background:linear-gradient(135deg,#94A3B8,#64748B);">Coming soon</div>
            </div>
        </div>

        <div class="payment-method unavailable" aria-disabled="true">
            <div class="method-icon">
                <!-- paypal icon -->
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 7h9l-1 6H8z" fill="#F3F4F6" stroke="#94A3B8" stroke-width="1"/>
                </svg>
            </div>
            <div class="method-info">
                <div class="method-title">PayPal</div>
                <div class="method-desc">Pay using your PayPal account.</div>
            </div>
            <div>
                <div class="method-badge" style="background:linear-gradient(135deg,#94A3B8,#64748B);">Coming soon</div>
            </div>
        </div>

        <div class="payment-method unavailable" aria-disabled="true">
            <div class="method-icon">
                <!-- apple/google icon -->
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="9" stroke="#CBD5E1" stroke-width="1" fill="#F8FAFC"/>
                </svg>
            </div>
            <div class="method-info">
                <div class="method-title">Apple Pay / Google Pay</div>
                <div class="method-desc">Fast mobile payments.</div>
            </div>
            <div>
                <div class="method-badge" style="background:linear-gradient(135deg,#94A3B8,#64748B);">Coming soon</div>
            </div>
        </div>

    </div>

    <p style="margin-top:1rem"><a href="{{ route('properties.show', $property) }}">Back to listing</a></p>
</div>

@endsection
