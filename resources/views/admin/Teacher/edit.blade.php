@extends('layouts.admin')

@php 
    $pageTitle = 'Edit Teacher'; 
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.teacher.list') }}" class="back-button">← Back</a>
        <h1 class="page-title">Edit Teacher</h1>
        <p class="page-subtitle">Update teacher information</p>
    </div>
</div>

<div class="form-container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.teacher.update', $teacher) }}" method="POST" class="teacher-form">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <h3 class="form-section-title">Login Credentials</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Full Name <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name', $teacher->user->name) }}"
                                placeholder="e.g., John Doe"
                                required
                            >
                            @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email Address <span class="required">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                value="{{ old('email', $teacher->user->email) }}"
                                placeholder="e.g., teacher@school.com"
                                required
                            >
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone" class="form-label">
                                Phone Number <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="phone" 
                                id="phone" 
                                class="form-control @error('phone') is-invalid @enderror" 
                                value="{{ old('phone', $teacher->user->phone) }}"
                                placeholder="e.g., +1234567890"
                                required
                            >
                            @error('phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="employee_id" class="form-label">
                                Employee ID <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="employee_id" 
                                id="employee_id" 
                                class="form-control @error('employee_id') is-invalid @enderror" 
                                value="{{ old('employee_id', $teacher->employee_id) }}"
                                placeholder="e.g., EMP001"
                                required
                            >
                            @error('employee_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="form-label">
                                New Password
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Leave blank to keep current password"
                            >
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                            <small class="form-hint">Leave blank if you don't want to change the password</small>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">
                                Confirm New Password
                            </label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                class="form-control"
                                placeholder="Re-enter new password"
                            >
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Professional Details</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="qualification" class="form-label">
                                Qualification
                            </label>
                            <input 
                                type="text" 
                                name="qualification" 
                                id="qualification" 
                                class="form-control @error('qualification') is-invalid @enderror" 
                                value="{{ old('qualification', $teacher->qualification) }}"
                                placeholder="e.g., M.Ed, B.Sc"
                            >
                            @error('qualification')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="experience_years" class="form-label">
                                Experience (Years)
                            </label>
                            <input 
                                type="number" 
                                name="experience_years" 
                                id="experience_years" 
                                class="form-control @error('experience_years') is-invalid @enderror" 
                                value="{{ old('experience_years', $teacher->experience_years) }}"
                                min="0"
                                placeholder="0"
                            >
                            @error('experience_years')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="joining_date" class="form-label">
                                Joining Date
                            </label>
                            <input 
                                type="date" 
                                name="joining_date" 
                                id="joining_date" 
                                class="form-control @error('joining_date') is-invalid @enderror" 
                                value="{{ old('joining_date', $teacher->joining_date?->format('Y-m-d')) }}"
                            >
                            @error('joining_date')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="salary" class="form-label">
                                Salary
                            </label>
                            <input 
                                type="number" 
                                name="salary" 
                                id="salary" 
                                class="form-control @error('salary') is-invalid @enderror" 
                                value="{{ old('salary', $teacher->salary) }}"
                                min="0"
                                step="0.01"
                                placeholder="0.00"
                            >
                            @error('salary')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.teacher.list') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Update Teacher
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="info-card">
        <h3>ℹ️ Teacher Information</h3>
        <ul>
            <li><strong>Created:</strong> {{ $teacher->created_at->format('M d, Y h:i A') }}</li>
            <li><strong>Last Updated:</strong> {{ $teacher->updated_at->format('M d, Y h:i A') }}</li>
            <li><strong>Classes Assigned:</strong> {{ $teacher->classSubjects->count() }}</li>
            <li><strong>Account Status:</strong> {{ $teacher->user->is_active ? 'Active' : 'Inactive' }}</li>
        </ul>
    </div>
</div>

@endsection
