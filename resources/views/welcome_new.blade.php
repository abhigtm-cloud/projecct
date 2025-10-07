@extends('layouts.app')

@section('title', 'Welcome to EduPlatform')

@section('content')
<!-- Hero Section -->
<div class="hero-section text-white text-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="hero-content fade-in">
                    <h1 class="display-3 fw-bold mb-4">
                        Welcome to <span class="text-warning">EduPlatform</span>
                    </h1>
                    <p class="lead mb-5">
                        Discover, learn, and grow with our comprehensive course management system. 
                        Join thousands of learners and educators building the future together.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('Course.index') }}" class="btn btn-light btn-lg px-4 hover-scale">
                            <i class="bi bi-book me-2"></i>Browse Courses
                        </a>
                        <a href="{{ route('course.create') }}" class="btn btn-outline-light btn-lg px-4 hover-scale">
                            <i class="bi bi-plus-circle me-2"></i>Create Course
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-dark mb-3">Why Choose EduPlatform?</h2>
            <p class="lead text-muted">Everything you need to create and manage amazing learning experiences</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 fade-in-up">
                <div class="card h-100 text-center border-0 shadow-sm hover-scale">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-mortarboard text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Expert Instructors</h4>
                        <p class="text-muted">Learn from industry experts and experienced educators who bring real-world knowledge to every course.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 fade-in-up" style="animation-delay: 0.2s;">
                <div class="card h-100 text-center border-0 shadow-sm hover-scale">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-lightning-charge text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Fast & Intuitive</h4>
                        <p class="text-muted">Our platform is designed for speed and ease of use, making learning and teaching effortless and enjoyable.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 fade-in-up" style="animation-delay: 0.4s;">
                <div class="card h-100 text-center border-0 shadow-sm hover-scale">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-shield-check text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Quality Assured</h4>
                        <p class="text-muted">Every course goes through our quality assurance process to ensure you receive the best learning experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="py-5">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-lg-3 col-6">
                <div class="stat-item fade-in-up">
                    <h3 class="display-4 fw-bold text-primary mb-2">100+</h3>
                    <p class="text-muted mb-0">Active Courses</p>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="stat-item fade-in-up" style="animation-delay: 0.1s;">
                    <h3 class="display-4 fw-bold text-success mb-2">50+</h3>
                    <p class="text-muted mb-0">Expert Instructors</p>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="stat-item fade-in-up" style="animation-delay: 0.2s;">
                    <h3 class="display-4 fw-bold text-info mb-2">1000+</h3>
                    <p class="text-muted mb-0">Happy Students</p>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="stat-item fade-in-up" style="animation-delay: 0.3s;">
                    <h3 class="display-4 fw-bold text-warning mb-2">98%</h3>
                    <p class="text-muted mb-0">Success Rate</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-2">Ready to Start Learning?</h3>
                <p class="mb-0">Join our community of learners and educators today. Create your first course or explore existing ones!</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('course.create') }}" class="btn btn-light btn-lg">
                    <i class="bi bi-rocket-takeoff me-2"></i>Get Started
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 0;
    margin: -2rem -2rem 0 -2rem;
    padding: 4rem 2rem !important;
}

.hero-content {
    animation: fadeInUp 1s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.8s ease-out both;
}

.hover-scale {
    transition: all 0.3s ease;
}

.hover-scale:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.feature-icon {
    transition: all 0.3s ease;
}

.card:hover .feature-icon {
    transform: scale(1.1);
}

.stat-item h3 {
    font-size: 3rem;
    background: linear-gradient(135deg, currentColor, currentColor);
    -webkit-background-clip: text;
}

@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 1rem !important;
    }
    
    .display-3 {
        font-size: 2.5rem;
    }
    
    .stat-item h3 {
        font-size: 2rem;
    }
}
</style>
@endsection