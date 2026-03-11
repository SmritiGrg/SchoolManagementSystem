@extends('layouts.admin')

@php
    $pageTitle = 'Assign Teacher to Class';
@endphp

@section('admin-content')
    <div class="content-header">
        <div class="header-left">
            <a href="{{ route('admin.class-subject.list') }}" class="back-button">← Back</a>
            <h1 class="page-title">Assign Teacher to Class</h1>
            <p class="page-subtitle">Assign a teacher and their subject to a class</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="form-container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.class-subject.store') }}" method="POST">
                    @csrf

                    <div class="form-section">
                        <h3 class="form-section-title">Assignment Details</h3>

                        <div class="form-row">
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
                                            {{ $class->class_name }} {{ $class->section ? '(' . $class->section . ')' : '' }} - {{ $class->academic_year }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="teacher_id" class="form-label">
                                    Teacher <span class="required">*</span>
                                </label>
                                <select
                                    name="teacher_id"
                                    id="teacher_id"
                                    class="form-control @error('teacher_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="">Select Teacher</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->user->name }}
                                            @if($teacher->subject)
                                                - {{ $teacher->subject->subject_name }} ({{ $teacher->subject->subject_code }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.class-subject.list') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Assign Teacher</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="info-card">
            <h3>📋 Guidelines</h3>
            <ul>
                <li>Each teacher has one assigned subject</li>
                <li>When a teacher is assigned, their subject is automatically assigned too</li>
                <li>The same subject can only appear once in a class</li>
            </ul>
        </div>
    </div>
@endsection