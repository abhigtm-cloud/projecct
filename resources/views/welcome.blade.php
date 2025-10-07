@extends('layouts.app')

@section('title', 'Welcome to EduPlatform')

@section('content')
<!-- Hero Section -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            Welcome to EduPlatform
        </h1>
        <p class="page-subtitle">
            Discover, learn, and grow with our comprehensive course management system. 
            Join thousands of learners and educators building the future together.
        </p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('Course.index') }}" class="btn btn-lg">
                Browse Courses
            </a>
            <a href="{{ route('course.create') }}" class="btn btn-outline btn-lg">
                Create Course
            </a>
        </div>
    </div>
</div>

<!-- Features Section -->
<div style="padding: 40px 0; background: #f8f9fa;">
    <div class="container">
        <div class="text-center mb-4">
            <h2 style="font-size: 24px; font-weight: 600; margin-bottom: 10px; color: #495057;">Why Choose EduPlatform?</h2>
            <p style="font-size: 16px; color: #6c757d;">Everything you need to create and manage learning experiences</p>
        </div>
        
        <div class="row">
            <div class="col col-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title">Expert Instructors</h4>
                        <p class="card-text">Learn from industry experts and experienced educators who bring real-world knowledge to every course.</p>
                    </div>
                </div>
            </div>
            
            <div class="col col-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title">Easy to Use</h4>
                        <p class="card-text">Our platform is designed for simplicity and ease of use, making learning and teaching straightforward.</p>
                    </div>
                </div>
            </div>
            
            <div class="col col-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h4 class="card-title">Quality Content</h4>
                        <p class="card-text">Every course goes through our quality assurance process to ensure you receive the best learning experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="stats">
    <div class="stat-item">
        <div class="stat-number">100+</div>
        <div class="stat-label">Active Courses</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">50+</div>
        <div class="stat-label">Expert Instructors</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">1000+</div>
        <div class="stat-label">Happy Students</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">98%</div>
        <div class="stat-label">Success Rate</div>
    </div>
</div>

<!-- CTA Section -->
<div style="padding: 50px 0; background: #007bff; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 style="font-weight: 600; margin-bottom: 10px;">Ready to Start Learning?</h3>
                <p style="margin: 0;">Join our community of learners and educators today. Create your first course or explore existing ones!</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ route('course.create') }}" class="btn btn-light btn-lg">
                    Get Started
                </a>
            </div>
        </div>
    </div>
</div>
@endsection