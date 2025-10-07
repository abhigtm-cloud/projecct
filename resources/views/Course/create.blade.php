@extends('layouts.app')

@section('title', 'Create New Course - EduPlatform')

@section('content')
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Create New Course</h1>
        <p class="page-subtitle">Share your knowledge and create an amazing learning experience</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col col-8" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('Course.store') }}" enctype="multipart/form-data" id="courseForm">
                        @csrf
                        
                        <!-- Course Title -->
                        <div class="form-group">
                            <label for="title" class="form-label">Course Title</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   placeholder="Enter an engaging course title..."
                                   value="{{ old('title') }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Instructor Name -->
                        <div class="form-group">
                            <label for="instructor" class="form-label">Instructor Name</label>
                            <input type="text" 
                                   class="form-control @error('instructor') is-invalid @enderror" 
                                   id="instructor" 
                                   name="instructor" 
                                   placeholder="Enter instructor's full name..."
                                   value="{{ old('instructor') }}"
                                   required>
                            @error('instructor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Course Head -->
                        <div class="form-group">
                            <label for="coursehead" class="form-label">Course Head</label>
                            <input type="text" 
                                   class="form-control @error('coursehead') is-invalid @enderror" 
                                   id="coursehead" 
                                   name="coursehead" 
                                   placeholder="Enter course head or department..."
                                   value="{{ old('coursehead') }}"
                                   required>
                            @error('coursehead')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Course Image -->
                        <div class="form-group">
                            <label for="image" class="form-label">
                                Course Image <small style="color: #666;">(Optional)</small>
                            </label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   onchange="previewImage(this)">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" style="display: none; margin-top: 15px;">
                                <div class="text-center">
                                    <img id="preview" src="" alt="Preview" style="max-height: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    <div style="margin-top: 10px;">
                                        <small style="color: #666;">Image Preview</small>
                                    </div>
                                </div>
                            </div>
                            
                            <small style="color: #666; margin-top: 5px; display: block;">
                                Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                            </small>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between" style="margin-top: 30px;">
                            <a href="{{ route('Course.index') }}" class="btn btn-outline-secondary">
                                Back to Courses
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                Create Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        };
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.style.display = 'none';
    }
}

// Form submission animation
document.getElementById('courseForm').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.innerHTML = 'Creating Course...';
    submitBtn.disabled = true;
});
</script>
@endsection