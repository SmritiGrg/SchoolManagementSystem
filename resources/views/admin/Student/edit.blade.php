@extends('layouts.admin')

@php 
    $pageTitle = 'Edit Student'; 
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.student.list') }}" class="back-button">← Back</a>
        <h1 class="page-title">Edit Student</h1>
        <p class="page-subtitle">Update student information</p>
    </div>
</div>

<div class="form-container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.student.update', $student) }}" method="POST" class="student-form">
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
                                value="{{ old('name', $student->user->name) }}"
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
                                value="{{ old('email', $student->user->email) }}"
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
                                value="{{ old('phone', $student->user->phone) }}"
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
                                class="form-control @error('admission_number') is-invalid @enderror" 
                                value="{{ old('admission_number', $student->admission_number) }}"
                                placeholder="e.g., ADM-0001"
                                required
                            >
                            @error('admission_number')
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
                            <label class="form-label">
                                Account Status
                            </label>
                            <div class="info-display">
                                @if($student->user->is_active)
                                    <span class="badge badge-success">Active Account</span>
                                @else
                                    <span class="badge badge-danger">Inactive Account</span>
                                @endif
                            </div>
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
                                value="{{ old('roll_number', $student->roll_number) }}"
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
                                    <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
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
                                value="{{ old('date_of_birth', $student->date_of_birth?->format('Y-m-d')) }}"
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
                                <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
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
                                value="{{ old('admission_date', $student->admission_date?->format('Y-m-d')) }}"
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
                                <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="graduated" {{ old('status', $student->status) == 'graduated' ? 'selected' : '' }}>Graduated</option>
                                <option value="suspended" {{ old('status', $student->status) == 'suspended' ? 'selected' : '' }}>Suspended</option>
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
                        >{{ old('address', $student->address) }}</textarea>
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
                                value="{{ old('parent_name', $student->parent_name) }}"
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
                                value="{{ old('parent_phone', $student->parent_phone) }}"
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
                        Update Student
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="info-card">
        <h3>ℹ️ Student Information</h3>
        <ul>
            <li><strong>Created:</strong> {{ $student->created_at->format('M d, Y h:i A') }}</li>
            <li><strong>Last Updated:</strong> {{ $student->updated_at->format('M d, Y h:i A') }}</li>
            <li><strong>Attendance Records:</strong> {{ $student->attendances->count() }}</li>
            <li><strong>Result Records:</strong> {{ $student->results->count() }}</li>
        </ul>
    </div>
</div>

@endsection
