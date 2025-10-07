@extends('layouts.app')

@section('title', 'All Courses - EduPlatform')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Our Courses</h1>
        <p class="page-subtitle">Discover amazing courses taught by expert instructors</p>
        <a href="{{ route('course.create') }}" class="btn btn-primary btn-lg">
            Add New Course
        </a>
    </div>
</div>

<div class="container">
    @if($courses->count() > 0)
        <div class="row">
            @foreach ($courses as $course)
                <div class="col col-4">
                    <div class="card">
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" 
                                 alt="{{ $course->title }}" 
                                 class="course-image">
                        @else
                            <div class="course-placeholder">
                                <span style="font-size: 24px; color: #6c757d;">No Image</span>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <h3 class="card-title">{{ $course->title }}</h3>
                            
                            <div class="course-info">
                                <div class="course-meta">
                                    <div>
                                        <small style="color: #6c757d; display: block;">Instructor</small>
                                        <strong>{{ $course->instructor }}</strong>
                                    </div>
                                </div>
                                
                                <div class="course-meta">
                                    <div>
                                        <small style="color: #6c757d; display: block;">Course Head</small>
                                        <strong>{{ $course->coursehead }}</strong>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="#" class="btn">View Details</a>
                        </div>
                        
                        <div class="card-footer">
                            <small style="color: #6c757d;">
                                {{ $course->created_at->format('M d, Y') }}
                            </small>
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-secondary" style="margin-right: 5px;">
                                    Edit
                                </a>
                                <a href="#" class="btn btn-sm btn-danger">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📚</div>
            <h3 class="empty-state-title">No Courses Available</h3>
            <p class="empty-state-text">Get started by creating your first course!</p>
            <a href="{{ route('course.create') }}" class="btn btn-lg">
                <span class="icon icon-add"></span>Create First Course
            </a>
        </div>
    @endif
</div>
@endsection