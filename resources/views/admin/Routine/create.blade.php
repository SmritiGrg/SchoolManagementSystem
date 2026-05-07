@extends('layouts.admin')

@php $pageTitle = 'Add Routine Slot'; @endphp

@section('admin-content')

<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.routine.index', $selectedClassId ? ['class_id'=>$selectedClassId] : []) }}" class="back-button">← Back</a>
        <h1 class="page-title">Add Routine Slot</h1>
        <p class="page-subtitle">Schedule a new period in the timetable</p>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="alert-icon-svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
        {{ session('error') }}
    </div>
@endif

<div class="form-container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.routine.store') }}" method="POST" class="student-form" id="routine-form">
                @csrf

                <div class="form-section">
                    <h3 class="form-section-title">Class & Subject</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="class_id" class="form-label">Class <span class="required">*</span></label>
                            <select name="class_id" id="class_id" class="form-control @error('class_id') is-invalid @enderror" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id', $selectedClassId) == $class->id ? 'selected' : '' }}>
                                        {{ $class->class_name }}{{ $class->section ? ' "'.$class->section.'"' : '' }} — {{ $class->academic_year }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="subject_id" class="form-label">Subject <span class="required">*</span></label>
                            <select name="subject_id" id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" required>
                                <option value="">Select Subject</option>
                                @foreach($classSubjects as $cs)
                                    <option value="{{ $cs->subject_id }}" data-teacher="{{ $cs->teacher_id }}" {{ old('subject_id') == $cs->subject_id ? 'selected' : '' }}>
                                        {{ $cs->subject->subject_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="teacher_id" class="form-label">Teacher <span class="required">*</span></label>
                            <select name="teacher_id" id="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror" required>
                                <option value="">Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->user->name }} ({{ $teacher->employee_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="room" class="form-label">Room / Location</label>
                            <input type="text" name="room" id="room" class="form-control @error('room') is-invalid @enderror"
                                value="{{ old('room') }}" placeholder="e.g., Room 101, Lab A">
                            @error('room') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Schedule</h3>

                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label class="form-label">Day <span class="required">*</span></label>
                        <div class="day-picker">
                            @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                <label class="day-chip {{ old('day') == $day ? 'selected' : '' }}">
                                    <input type="radio" name="day" value="{{ $day }}" {{ old('day') == $day ? 'checked' : '' }} required>
                                    {{ substr($day, 0, 3) }}
                                </label>
                            @endforeach
                        </div>
                        @error('day') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="start_time" class="form-label">Start Time <span class="required">*</span></label>
                            <input type="time" name="start_time" id="start_time"
                                class="form-control @error('start_time') is-invalid @enderror"
                                value="{{ old('start_time') }}" required>
                            @error('start_time') <span class="error-message">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_time" class="form-label">End Time <span class="required">*</span></label>
                            <input type="time" name="end_time" id="end_time"
                                class="form-control @error('end_time') is-invalid @enderror"
                                value="{{ old('end_time') }}" required>
                            @error('end_time') <span class="error-message">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.routine.index', $selectedClassId ? ['class_id'=>$selectedClassId] : []) }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Save Slot
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="info-card">
        <h3>📋 Guidelines</h3>
        <ul>
            <li>Select a class first — subject and teacher options will update automatically.</li>
            <li>End time must be after start time.</li>
            <li>A teacher cannot be assigned two overlapping slots on the same day.</li>
            <li>Room is optional but recommended.</li>
        </ul>
    </div>
</div>

@push('styles')
<style>
.day-picker { display:flex; gap:.5rem; flex-wrap:wrap; }
.day-chip { display:inline-flex; align-items:center; justify-content:center; padding:.45rem 1rem; border:2px solid #e5e7eb; border-radius:8px; cursor:pointer; font-size:.85rem; font-weight:600; color:#374151; transition:all .15s; user-select:none; }
.day-chip input { display:none; }
.day-chip:hover { border-color:#6366f1; color:#4f46e5; background:#ede9fe; }
.day-chip.selected, .day-chip:has(input:checked) { background:#6366f1; border-color:#6366f1; color:#fff; }
</style>
@endpush

@push('scripts')
<script>
// Auto-fill teacher when subject is selected
document.getElementById('subject_id').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    const teacherId = selected.dataset.teacher;
    if (teacherId) {
        document.getElementById('teacher_id').value = teacherId;
    }
});

// Reload subject list when class changes
document.getElementById('class_id').addEventListener('change', function () {
    const classId = this.value;
    if (!classId) return;
    fetch(`/admin/routine/class-subjects?class_id=${classId}`)
        .then(r => r.json())
        .then(data => {
            const subjectSel = document.getElementById('subject_id');
            const teacherSel = document.getElementById('teacher_id');
            subjectSel.innerHTML = '<option value="">Select Subject</option>';
            teacherSel.innerHTML = '<option value="">Select Teacher</option>';
            data.forEach(cs => {
                subjectSel.innerHTML += `<option value="${cs.subject_id}" data-teacher="${cs.teacher_id}">${cs.subject_name}</option>`;
                teacherSel.innerHTML += `<option value="${cs.teacher_id}">${cs.teacher_name}</option>`;
            });
        });
});

// Day chip visual toggle
document.querySelectorAll('.day-chip input').forEach(input => {
    input.addEventListener('change', () => {
        document.querySelectorAll('.day-chip').forEach(c => c.classList.remove('selected'));
        input.closest('.day-chip').classList.add('selected');
    });
});
</script>
@endpush

@endsection
