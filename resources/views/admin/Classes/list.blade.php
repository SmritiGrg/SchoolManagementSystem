@extends('layouts.admin')

@php
    $pageTitle = 'Classes Management';
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <h1 class="page-title">Classes</h1>
        <p class="page-subtitle">Manage all classes in the system</p>
    </div>
    <div class="header-right">
        <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">
            <span class="btn-icon">+</span>
            Add New Class
        </a>
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

@if(session('error'))
    <div class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="alert-icon-svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
        {{ session('error') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <form method="GET" action="{{ route('admin.classes.list') }}" class="filter-form">
            <div class="search-box">
                <input type="text" name="search" id="searchInput" placeholder="Search classes..." class="search-input" value="{{ request('search') }}">
                <span class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="search-icon-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </span>
            </div>

            <div class="filter-group">
                <select name="academic_year" class="filter-select">
                    <option value="">All Years</option>
                    @foreach($academicYears as $year)
                        <option value="{{ $year }}" {{ request('academic_year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-secondary btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                    </svg>
                    Filter
                </button>

                @if(request()->hasAny(['search', 'academic_year']))
                    <a href="{{ route('admin.classes.list') }}" class="btn btn-secondary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                        Clear
                    </a>
                @endif

                <span class="result-count">{{ $classes->total() }} classes found</span>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <form id="bulk-form" action="{{ route('admin.classes.bulk-destroy') }}" method="POST">
            @csrf
            @method('DELETE')
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:40px;">
                        <input type="checkbox" id="check-all" title="Select all">
                    </th>
                    <th>ID</th>
                    <th>Class Name</th>
                    <th>Section</th>
                    <th>Academic Year</th>
                    <th>Class Teacher</th>
                    <th>Students</th>
                    <th>Subjects</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $class)
                    <tr>
                        <td>
                            <input type="checkbox" name="ids[]" value="{{ $class->id }}" class="row-check">
                        </td>
                        <td>{{ $class->id }}</td>
                        <td>
                            <div class="user-info">
                                <span class="user-name">{{ $class->class_name }}</span>
                            </div>
                        </td>
                        <td>
                            @if($class->section)
                                <span class="badge badge-code">{{ $class->section }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{ $class->academic_year }}</td>
                        <td>{{ $class->classTeacher->user->name ?? 'Not Assigned' }}</td>
                        <td>
                            <span class="badge badge-count">{{ $class->students_count }}</span>
                        </td>
                        <td>
                            <span class="badge badge-count">{{ $class->class_subjects_count }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.classes.show', $class) }}" class="btn-action btn-view" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.classes.edit', $class) }}" class="btn-action btn-edit" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <a href="#delete-modal-{{ $class->id }}" class="btn-action btn-delete" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </a>

                                <div id="delete-modal-{{ $class->id }}" class="modal">
                                    <div class="modal-overlay">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Confirm Delete</h3>
                                                <a href="#" class="modal-close">&times;</a>
                                            </div>
                                            <div class="modal-body">
                                                <div class="modal-icon-warning">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                    </svg>
                                                </div>
                                                <p class="modal-text">Are you sure you want to delete <strong>{{ $class->class_name }} {{ $class->section ? '('.$class->section.')' : '' }}</strong>?</p>
                                                <p class="modal-subtext">This will also remove all associated students and subjects. This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="#" class="btn btn-secondary">Cancel</a>
                                                <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="empty-state">
                            <div class="empty-content">
                                <span class="empty-icon">🏫</span>
                                <h3>No classes found</h3>
                                <p>Start by adding your first class</p>
                                <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">Add Class</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

        </table>
        </form>
    </div>

    <div class="card-footer">
        <div class="pagination-info">
            @if($classes->hasPages())
                Showing {{ $classes->firstItem() }} to {{ $classes->lastItem() }} of {{ $classes->total() }} entries
            @else
                {{ $classes->total() }} entries
            @endif
            &nbsp;|&nbsp;
            <label style="display:inline-flex;align-items:center;gap:6px;cursor:pointer;">
                <input type="checkbox" id="check-all-footer"> Check all
            </label>
            <button id="bulk-delete-btn" type="button" class="btn btn-danger btn-sm" style="display:none;margin-left:10px;" onclick="confirmBulkDelete()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                Delete Selected (<span id="selected-count">0</span>)
            </button>
        </div>
        @if($classes->hasPages())
        <div class="pagination">
            {{ $classes->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    const allCheckboxes = () => document.querySelectorAll('.row-check');
    const countEl       = document.getElementById('selected-count');
    const bulkBtn       = document.getElementById('bulk-delete-btn');

    function syncState() {
        const checked = document.querySelectorAll('.row-check:checked').length;
        countEl.textContent = checked;
        bulkBtn.style.display = checked > 0 ? 'inline-flex' : 'none';

        const total = allCheckboxes().length;
        document.getElementById('check-all').checked        = checked === total && total > 0;
        document.getElementById('check-all-footer').checked = checked === total && total > 0;
    }

    function toggleAll(checked) {
        allCheckboxes().forEach(cb => cb.checked = checked);
        document.getElementById('check-all').checked        = checked;
        document.getElementById('check-all-footer').checked = checked;
        syncState();
    }

    document.getElementById('check-all').addEventListener('change', e => toggleAll(e.target.checked));
    document.getElementById('check-all-footer').addEventListener('change', e => toggleAll(e.target.checked));
    document.addEventListener('change', e => { if (e.target.classList.contains('row-check')) syncState(); });

    function confirmBulkDelete() {
        const count = document.querySelectorAll('.row-check:checked').length;
        if (count === 0) return;
        document.getElementById('bulk-count').textContent = count;
        window.location.hash = 'bulk-delete-modal';
    }

    document.getElementById('confirm-bulk-delete').addEventListener('click', () => {
        document.getElementById('bulk-form').submit();
    });
</script>
@endpush

{{-- Bulk Delete Confirmation Modal --}}
<div id="bulk-delete-modal" class="modal">
    <div class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirm Bulk Delete</h3>
                <a href="#" class="modal-close">&times;</a>
            </div>
            <div class="modal-body">
                <div class="modal-icon-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <p class="modal-text">Are you sure you want to delete <strong><span id="bulk-count">0</span> class(es)</strong>?</p>
                <p class="modal-subtext">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <button id="confirm-bulk-delete" type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

@endsection
