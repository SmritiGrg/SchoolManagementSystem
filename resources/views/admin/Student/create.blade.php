@extends('layouts.admin')

@php 
    $pageTitle = 'Create Student'; 
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.student.list') }}" class="back-button">← Back</a>
        <h1 class="page-title">Create New Student</h1>
        <p class="page-subtitle">Add a new student with login credentials</p>
    </div>
</div>

<div class="form-container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.student.store') }}" method="POST" class="student-form">
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
                                value="{{ old('email') }}"
                                placeholder="e.g., student@school.com"
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
                                value="{{ old('phone') }}"
                                placeholder="e.g., +1234567890"
                                required
                            >
                            @error('phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="admission_number" class="form-label">
                                Admission Number <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="admission_number" 
                                id="admission_number" 
                                class="form-control form-control-readonly @error('admission_number') is-invalid @enderror" 
                                value="{{ old('admission_number', $nextAdmissionNumber) }}"
                                readonly
                                required
                            >
                            @error('admission_number')
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
                                type="text" 
                                name="password" 
                                id="password" 
                                class="form-control form-control-readonly @error('password') is-invalid @enderror"
                                value="{{ old('password', $generatedPassword) }}"
                                readonly
                                required
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
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Student Details</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="roll_number" class="form-label">
                                Roll Number
                            </label>
                            <input 
                                type="text" 
                                name="roll_number" 
                                id="roll_number" 
                                class="form-control @error('roll_number') is-invalid @enderror" 
                                value="{{ old('roll_number') }}"
                                placeholder="e.g., 001"
                            >
                            @error('roll_number')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="class_id" class="form-label">
                                Class <span class="required">*</span>
                            </label>
                            <select 
                                name="class_id" 
                                id="class_id" 
                                class="form-control @error('class_id') is-invalid @enderror"
                                required
                            >
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }} {{ $class->section ? '('.$class->section.')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="date_of_birth" class="form-label">
                                Date of Birth
                            </label>
                            <input 
                                type="date" 
                                name="date_of_birth" 
                                id="date_of_birth" 
                                class="form-control @error('date_of_birth') is-invalid @enderror" 
                                value="{{ old('date_of_birth') }}"
                            >
                            @error('date_of_birth')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender" class="form-label">
                                Gender
                            </label>
                            <select 
                                name="gender" 
                                id="gender" 
                                class="form-control @error('gender') is-invalid @enderror"
                            >
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="admission_date" class="form-label">
                                Admission Date
                            </label>
                            <input 
                                type="date" 
                                name="admission_date" 
                                id="admission_date" 
                                class="form-control @error('admission_date') is-invalid @enderror" 
                                value="{{ old('admission_date', date('Y-m-d')) }}"
                            >
                            @error('admission_date')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">
                                Status
                            </label>
                            <select 
                                name="status" 
                                id="status" 
                                class="form-control @error('status') is-invalid @enderror"
                            >
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="graduated" {{ old('status') == 'graduated' ? 'selected' : '' }}>Graduated</option>
                                <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                            </select>
                            @error('status')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">
                            Address
                        </label>
                        <textarea 
                            name="address" 
                            id="address" 
                            class="form-control @error('address') is-invalid @enderror" 
                            rows="3"
                            placeholder="Enter full address"
                        >{{ old('address') }}</textarea>
                        @error('address')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Parent/Guardian Information</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="parent_name" class="form-label">
                                Parent/Guardian Name
                            </label>
                            <input 
                                type="text" 
                                name="parent_name" 
                                id="parent_name" 
                                class="form-control @error('parent_name') is-invalid @enderror" 
                                value="{{ old('parent_name') }}"
                                placeholder="e.g., Jane Doe"
                            >
                            @error('parent_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="parent_phone" class="form-label">
                                Parent/Guardian Phone
                            </label>
                            <input 
                                type="text" 
                                name="parent_phone" 
                                id="parent_phone" 
                                class="form-control @error('parent_phone') is-invalid @enderror" 
                                value="{{ old('parent_phone') }}"
                                placeholder="e.g., +1234567890"
                            >
                            @error('parent_phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.student.list') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Create Student
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
            <li>Admission number is auto-generated (ADM-0001 format)</li>
            <li>Password is auto-generated securely (12 characters)</li>
            <li>Login credentials will be sent to student's email</li>
            <li>Student will have immediate access to their dashboard</li>
            <li>Student should change password after first login</li>
        </ul>
    </div>
</div>

@endsection
