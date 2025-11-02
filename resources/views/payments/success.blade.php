@extends('nextbnb.layouts.app')

@section('title', 'Payment successful')

@section('content')
<div class="container">
    <div class="success-card success-wrapper">
        <div style="text-align:center; width:100%">
            <svg class="checkmark" viewBox="0 0 52 52">
                <circle class="checkmark-circle" cx="26" cy="26" r="24" fill="none" stroke="#D1FAE5" stroke-width="4"></circle>
                <path class="checkmark-check" fill="none" d="M14 27l6 6 18-18" stroke="#10B981" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <h1 style="margin-bottom:6px">Payment successful</h1>
            <p style="color:#475569; margin-bottom:10px">Your booking/payment was recorded as <strong>Cash at homestay</strong>.</p>
            <p class="muted">You'll be redirected to the home page shortly — or <a href="{{ route('home') }}">click here</a>.</p>
        </div>
    </div>
</div>

<script>
    // Redirect to home after 3 seconds
    setTimeout(function() {
        window.location.href = '{{ route('home') }}';
    }, 3000);
</script>

@endsection
