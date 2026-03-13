@extends('layouts.teacher')

@php 
    $pageTitle = 'My Students'; 
@endphp

@section('teacher-content')
<div class="content-header">
    <div class="header-left">
        <h1 class="page-title">My Students</h1>
        <p class="page-subtitle">View and manage students in your courses</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="alert-icon-svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('teacher.students') }}" class="filter-form">
            <div class="search-box">
                <input type="text" name="search" id="searchInput" placeholder="Search students..." class="search-input" value="{{ request('search') }}">
                <span class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="search-icon-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
            </div>
            
            <div class="filter-group">
                <select name="class_id" class="filter-select">
                    <option value="">All Classes</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}"
                            {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->class_name }} {{ $class->section ? '('.$class->section.')' : '' }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-secondary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    Filter
                </button>

                @if(request()->hasAny(['search', 'class_id']))
                    <a href="{{ route('teacher.students') }}" class="btn btn-secondary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                        Clear
                    </a>
                @endif

                <span class="result-count">{{ $students->total() ?? 0 }} students found</span>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Admission No.</th>
                    <th>Roll No.</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>
                            <div class="user-info">
                                <span class="user-name">{{ $student->user->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-code">{{ $student->admission_number }}</span>
                        </td>
                        <td>{{ $student->roll_number ?? 'N/A' }}</td>
                        <td>{{ $student->class->class_name ?? 'N/A' }}</td>
                        <td>{{ $student->user->email }}</td>
                        <td>{{ $student->user->phone ?? 'N/A' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#view-modal-{{ $student->id }}" class="btn-action btn-view" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>

                                <!-- View Modal -->
                                <div id="view-modal-{{ $student->id }}" class="modal">
                                    <div class="modal-overlay">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Student Details</h3>
                                                <a href="#" class="modal-close">&times;</a>
                                            </div>
                                            <div class="modal-body">
                                                <div style="padding: 1rem;">
                                                    <p><strong>Name:</strong> {{ $student->user->name }}</p>
                                                    <p><strong>Admission Number:</strong> {{ $student->admission_number }}</p>
                                                    <p><strong>Roll Number:</strong> {{ $student->roll_number ?? 'N/A' }}</p>
                                                    <p><strong>Class:</strong> {{ $student->class->class_name ?? 'N/A' }}</p>
                                                    <p><strong>Email:</strong> {{ $student->user->email }}</p>
                                                    <p><strong>Phone:</strong> {{ $student->user->phone ?? 'N/A' }}</p>
                                                    <p><strong>Gender:</strong> {{ ucfirst($student->gender ?? 'N/A') }}</p>
                                                    <p><strong>Date of Birth:</strong> {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') : 'N/A' }}</p>
                                                    <p><strong>Status:</strong> {{ ucfirst($student->status ?? 'N/A') }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="#" class="btn btn-secondary">Close</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <div class="empty-content">
                                <span class="empty-icon">👨‍🎓</span>
                                <h3>No students found</h3>
                                <p>No students are enrolled in your courses</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($students) && $students->hasPages())
        <div class="card-footer">
            <div class="pagination-info">
                Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} entries
            </div>
            <div class="pagination">
                {{ $students->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('.data-table tbody tr');
        
        tableRows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endpush

@endsection
