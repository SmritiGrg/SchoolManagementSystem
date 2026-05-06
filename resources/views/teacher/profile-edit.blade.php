@extends('layouts.teacher')

@php
    $pageTitle = 'Edit Profile';
@endphp

@section('teacher-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('teacher.profile') }}" class="back-button">← Back</a>
        <h1 class="page-title">Edit Profile</h1>
        <p class="page-subtitle">Update your personal information</p>
    </div>
</div>

<div class="form-container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('teacher.profile.update') }}" method="POST" class="student-form">
                @csrf
                @method('PUT')

                {{-- Account Information --}}
                <div class="form-section">
                    <h3 class="form-section-title">Account Information</h3>

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
                            <label for="phone" class="form-label">Phone Number</label>
                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone', $teacher->user->phone) }}"
                                placeholder="e.g., +1234567890"
                            >
                            @error('phone')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">New Password</label>
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
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                placeholder="Confirm new password"
                            >
                        </div>
                    </div>
                </div>

                {{-- Professional Details --}}
                <div class="form-section">
                    <h3 class="form-section-title">Professional Details</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="qualification" class="form-label">Qualification</label>
                            <input
                                type="text"
                                name="qualification"
                                id="qualification"
                                class="form-control @error('qualification') is-invalid @enderror"
                                value="{{ old('qualification', $teacher->qualification) }}"
                                placeholder="e.g., M.Sc. Mathematics"
                            >
                            @error('qualification')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="experience_years" class="form-label">Years of Experience</label>
                            <input
                                type="number"
                                name="experience_years"
                                id="experience_years"
                                class="form-control @error('experience_years') is-invalid @enderror"
                                value="{{ old('experience_years', $teacher->experience_years) }}"
                                min="0"
                                placeholder="e.g., 5"
                            >
                            @error('experience_years')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Read-only fields --}}
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Employee ID</label>
                            <input type="text" class="form-control" value="{{ $teacher->employee_id }}" disabled>
                            <small class="form-hint">Employee ID can only be changed by an administrator.</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Assigned Subject</label>
                            <input type="text" class="form-control" value="{{ $teacher->subject?->subject_name ?? 'Not assigned' }}" disabled>
                            <small class="form-hint">Subject assignment can only be changed by an administrator.</small>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('teacher.profile') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="info-card">
        <h3>ℹ️ Note</h3>
        <ul>
            <li>Employee ID and subject assignment can only be changed by an administrator.</li>
            <li>Leave the password fields blank to keep your current password.</li>
            <li><strong>Last Updated:</strong> {{ $teacher->updated_at->format('M d, Y h:i A') }}</li>
        </ul>
    </div>
</div>

@endsection
