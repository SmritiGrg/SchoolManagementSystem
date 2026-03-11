@extends('layouts.admin')

@php 
    $pageTitle = 'Create Teacher'; 
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.teacher.list') }}" class="back-button">← Back</a>
        <h1 class="page-title">Create New Teacher</h1>
        <p class="page-subtitle">Add a new teacher with login credentials</p>
    </div>
</div>

<div class="form-container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.teacher.store') }}" method="POST" class="teacher-form">
                @csrf

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
                                value="{{ old('name') }}"
                                placeholder="e.g., John Doe"
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
                                value="{{ old('email') }}"
                                placeholder="e.g., teacher@school.com"
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
                                value="{{ old('phone') }}"
                                placeholder="e.g., +1234567890"
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
                                class="form-control form-control-readonly @error('employee_id') is-invalid @enderror" 
                                value="{{ old('employee_id', $nextEmployeeId) }}"
                                readonly
                            >
                            @error('employee_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                            <small class="form-hint">Auto-generated based on database records</small>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password" class="form-label">
                                Password <span class="required">*</span>
                            </label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="form-control form-control-readonly @error('password') is-invalid @enderror"
                                value="{{ old('password', $generatedPassword) }}"
                                readonly
                            >
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                            <small class="form-hint">Auto-generated secure password (will be sent via email)</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Password Strength
                            </label>
                            <div class="password-strength-indicator">
                                <div class="strength-bar">
                                    <div class="strength-bar-fill"></div>
                                </div>
                                <span class="strength-text">Strong Password</span>
                            </div>
                            <small class="form-hint">Contains uppercase, lowercase, numbers & special characters</small>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="subject_id" class="form-label">
                                Subject <span class="required">*</span>
                            </label>

                            <select 
                                name="subject_id"
                                id="subject_id"
                                class="form-control @error('subject_id') is-invalid @enderror"
                                required
                            >
                                <option value="">Select Subject</option>

                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" 
                                        {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject_name }} ({{ $subject->subject_code }})
                                    </option>
                                @endforeach

                            </select>

                            @error('subject_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
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
                                value="{{ old('qualification') }}"
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
                                value="{{ old('experience_years', 0) }}"
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
                                value="{{ old('joining_date') }}"
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
                                value="{{ old('salary') }}"
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
                        Create Teacher
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="info-card">
        <h3>📋 Guidelines</h3>
        <ul>
            <li>All fields marked with <span class="required">*</span> are required</li>
            <li>Email must be unique in the system</li>
            <li>Employee ID is auto-generated and unique</li>
            <li>Password is auto-generated securely (12 characters)</li>
            <li>Login credentials will be sent to teacher's email</li>
            <li>Teacher will have immediate access to their dashboard</li>
            <li>Teacher should change password after first login</li>
        </ul>
    </div>
</div>

@endsection
