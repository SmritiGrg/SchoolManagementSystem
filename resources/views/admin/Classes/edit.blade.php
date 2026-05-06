@extends('layouts.admin')

@php
    $pageTitle = 'Edit Class';
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.classes.list') }}" class="back-button">← Back</a>
        <h1 class="page-title">Edit Class</h1>
        <p class="page-subtitle">Update class information</p>
    </div>
</div>

<div class="form-container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.classes.update', $class) }}" method="POST" class="student-form">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <h3 class="form-section-title">Class Information</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="class_name" class="form-label">
                                Class Name <span class="required">*</span>
                            </label>
                            <input
                                type="text"
                                name="class_name"
                                id="class_name"
                                class="form-control @error('class_name') is-invalid @enderror"
                                value="{{ old('class_name', $class->class_name) }}"
                                placeholder="e.g., Grade 10, Class 5"
                                required
                            >
                            @error('class_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="section" class="form-label">Section</label>
                            <input
                                type="text"
                                name="section"
                                id="section"
                                class="form-control @error('section') is-invalid @enderror"
                                value="{{ old('section', $class->section) }}"
                                placeholder="e.g., A, B, C"
                            >
                            @error('section')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="academic_year" class="form-label">
                                Academic Year <span class="required">*</span>
                            </label>
                            <input type="hidden" name="academic_year" id="academic_year" value="{{ old('academic_year', $class->academic_year) }}" required>
                            <div class="year-picker @error('academic_year') is-invalid @enderror" id="year-picker-display">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="year-picker-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                </svg>
                                <span id="year-picker-label">{{ old('academic_year', $class->academic_year) ?: 'Select Academic Year' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="year-picker-chevron">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            <div class="year-picker-dropdown" id="year-picker-dropdown">
                                <div class="year-picker-header">
                                    <button type="button" id="year-prev">&#8249;</button>
                                    <span id="year-range-label"></span>
                                    <button type="button" id="year-next">&#8250;</button>
                                </div>
                                <div class="year-picker-grid" id="year-grid"></div>
                            </div>
                            @error('academic_year')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                            <small class="form-hint">Select the start year — end year is set automatically</small>
                        </div>

                        <div class="form-group">
                            <label for="class_teacher_id" class="form-label">Class Teacher</label>
                            <select
                                name="class_teacher_id"
                                id="class_teacher_id"
                                class="form-control @error('class_teacher_id') is-invalid @enderror"
                            >
                                <option value="">No Class Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('class_teacher_id', $class->class_teacher_id) == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->user->name }} ({{ $teacher->employee_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('class_teacher_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.classes.list') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Update Class
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="info-card">
        <h3>ℹ️ Class Info</h3>
        <ul>
            <li><strong>Students:</strong> {{ $class->students->count() }}</li>
            <li><strong>Subjects:</strong> {{ $class->classSubjects->count() }}</li>
            <li><strong>Created:</strong> {{ $class->created_at->format('M d, Y h:i A') }}</li>
            <li><strong>Last Updated:</strong> {{ $class->updated_at->format('M d, Y h:i A') }}</li>
        </ul>
    </div>
</div>

@push('scripts')
<script>
(function () {
    const hidden   = document.getElementById('academic_year');
    const display  = document.getElementById('year-picker-display');
    const dropdown = document.getElementById('year-picker-dropdown');
    const label    = document.getElementById('year-picker-label');
    const grid     = document.getElementById('year-grid');
    const rangeEl  = document.getElementById('year-range-label');
    const prevBtn  = document.getElementById('year-prev');
    const nextBtn  = document.getElementById('year-next');

    const currentYear = new Date().getFullYear();
    // Start page so the current value is visible
    const existingStart = hidden.value ? parseInt(hidden.value.split('-')[0]) : currentYear;
    let pageStart = existingStart - (existingStart % 12);

    function renderGrid() {
        grid.innerHTML = '';
        rangeEl.textContent = pageStart + ' – ' + (pageStart + 11);
        for (let y = pageStart; y < pageStart + 12; y++) {
            const val = y + '-' + (y + 1);
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.textContent = val;
            btn.className = 'year-cell' + (hidden.value === val ? ' selected' : '');
            btn.addEventListener('click', () => {
                hidden.value = val;
                label.textContent = val;
                document.querySelectorAll('.year-cell').forEach(b => b.classList.remove('selected'));
                btn.classList.add('selected');
                dropdown.classList.remove('open');
            });
            grid.appendChild(btn);
        }
    }

    display.addEventListener('click', () => {
        dropdown.classList.toggle('open');
        renderGrid();
    });

    prevBtn.addEventListener('click', () => { pageStart -= 12; renderGrid(); });
    nextBtn.addEventListener('click', () => { pageStart += 12; renderGrid(); });

    document.addEventListener('click', e => {
        if (!display.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.remove('open');
        }
    });

    renderGrid();
})();
</script>
@endpush

@push('styles')
<style>
.year-picker {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    border: 1px solid var(--border-color, #e2e8f0);
    border-radius: 8px;
    cursor: pointer;
    background: #fff;
    user-select: none;
    transition: border-color .2s;
    position: relative;
}
.year-picker:hover { border-color: var(--primary-color, #6366f1); }
.year-picker-icon  { width: 18px; height: 18px; color: #6b7280; flex-shrink: 0; }
.year-picker-chevron { width: 16px; height: 16px; color: #6b7280; margin-left: auto; }
.year-picker-dropdown {
    display: none;
    position: absolute;
    z-index: 100;
    background: #fff;
    border: 1px solid var(--border-color, #e2e8f0);
    border-radius: 10px;
    box-shadow: 0 8px 24px rgba(0,0,0,.12);
    padding: 12px;
    width: 320px;
    margin-top: 4px;
}
.year-picker-dropdown.open { display: block; }
.year-picker-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    font-weight: 600;
    font-size: .9rem;
}
.year-picker-header button {
    background: none;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    width: 28px; height: 28px;
    cursor: pointer;
    font-size: 1.1rem;
    line-height: 1;
    color: #374151;
    transition: background .15s;
}
.year-picker-header button:hover { background: #f3f4f6; }
.year-picker-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 6px;
}
.year-cell {
    padding: 8px 4px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    background: #f9fafb;
    cursor: pointer;
    font-size: .8rem;
    text-align: center;
    transition: all .15s;
    color: #374151;
}
.year-cell:hover  { background: #ede9fe; border-color: #6366f1; color: #4f46e5; }
.year-cell.selected { background: #6366f1; border-color: #6366f1; color: #fff; font-weight: 600; }
</style>
@endpush

@endsection
