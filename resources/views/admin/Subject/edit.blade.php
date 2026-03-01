@extends('layouts.admin')

@php 
    $pageTitle = 'Edit Subject'; 
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.subject.list') }}" class="back-button">← Back</a>
        <h1 class="page-title">Edit Subject</h1>
        <p class="page-subtitle">Update subject information</p>
    </div>
</div>

<div class="form-container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.subject.update', $subject) }}" method="POST" class="subject-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="subject_name" class="form-label">
                        Subject Name <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="subject_name" 
                        id="subject_name" 
                        class="form-control @error('subject_name') is-invalid @enderror" 
                        value="{{ old('subject_name', $subject->subject_name) }}"
                        placeholder="e.g., Mathematics, English, Science"
                        required
                    >
                    @error('subject_name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Enter the full name of the subject</small>
                </div>

                <div class="form-group">
                    <label for="subject_code" class="form-label">
                        Subject Code <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="subject_code" 
                        id="subject_code" 
                        class="form-control @error('subject_code') is-invalid @enderror" 
                        value="{{ old('subject_code', $subject->subject_code) }}"
                        placeholder="e.g., MATH101, ENG101"
                        required
                    >
                    @error('subject_code')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <small class="form-hint">Enter a unique code for the subject</small>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.subject.list') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="btn-icon">✓</span>
                        Update Subject
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="info-card">
        <h3>ℹ️ Subject Information</h3>
        <ul>
            <li><strong>Created:</strong> {{ $subject->created_at->format('M d, Y h:i A') }}</li>
            <li><strong>Last Updated:</strong> {{ $subject->updated_at->format('M d, Y h:i A') }}</li>
            <li><strong>Classes Assigned:</strong> {{ $subject->classSubjects->count() }}</li>
        </ul>
    </div>
</div>

@endsection
