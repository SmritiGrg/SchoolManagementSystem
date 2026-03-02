@extends('layouts.admin')

@php 
    $pageTitle = 'Create Subject'; 
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.subject.list') }}" class="back-button">← Back</a>
        <h1 class="page-title">Create New Subject</h1>
        <p class="page-subtitle">Add a new subject to the system</p>
    </div>
</div>

<div class="form-container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.subject.store') }}" method="POST" class="subject-form">
                @csrf

                <div class="form-group">
                    <label for="subject_name" class="form-label">
                        Subject Name <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="subject_name" 
                        id="subject_name" 
                        class="form-control @error('subject_name') is-invalid @enderror" 
                        value="{{ old('subject_name') }}"
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
                        value="{{ old('subject_code') }}"
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Create Subject
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="info-card">
        <h3>📋 Guidelines</h3>
        <ul>
            <li>Subject name should be clear and descriptive</li>
            <li>Subject code must be unique across all subjects</li>
            <li>Use standard naming conventions (e.g., MATH101, ENG101)</li>
            <li>All fields marked with * are required</li>
        </ul>
    </div>
</div>

@endsection
