@extends('layouts.admin')

@php 
    $pageTitle = 'Teachers Management'; 
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <h1 class="page-title">Teachers</h1>
        <p class="page-subtitle">Manage all teachers in the system</p>
    </div>
    <div class="header-right">
        <a href="{{ route('admin.teacher.create') }}" class="btn btn-primary">
            <span class="btn-icon">+</span>
            Add New Teacher
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
        <span class="alert-icon">✕</span>
        {{ session('error') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search teachers..." class="search-input">
            <span class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="search-icon-svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </span>
        </div>
        <div class="filter-group">
            <span class="result-count">{{ $teachers->total() }} teachers found</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Employee ID</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Qualification</th>
                    <th>Experience</th>
                    <th>Classes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>
                            <div class="user-info">
                                <span class="user-name">{{ $teacher->user->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-code">{{ $teacher->employee_id }}</span>
                        </td>
                        <td>{{ $teacher->user->email }}</td>
                        <td>{{ $teacher->user->phone }}</td>
                        <td>{{ $teacher->qualification ?? 'N/A' }}</td>
                        <td>{{ $teacher->experience_years }} years</td>
                        <td>
                            <span class="badge badge-count">{{ $teacher->class_subjects_count }} classes</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.teacher.show', $teacher) }}" class="btn-action btn-view" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.teacher.edit', $teacher) }}" class="btn-action btn-edit" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <a href="#delete-modal-{{ $teacher->id }}" class="btn-action btn-delete" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </a>

                                <!-- Delete Confirmation Modal -->
                                <div id="delete-modal-{{ $teacher->id }}" class="modal">
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
                                                <p class="modal-text">Are you sure you want to delete <strong>{{ $teacher->user->name }}</strong>?</p>
                                                <p class="modal-subtext">This will also delete their user account. This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="#" class="btn btn-secondary">Cancel</a>
                                                <form action="{{ route('admin.teacher.destroy', $teacher) }}" method="POST" style="display: inline;">
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
                                <span class="empty-icon">👨‍🏫</span>
                                <h3>No teachers found</h3>
                                <p>Start by adding your first teacher</p>
                                <a href="{{ route('admin.teacher.create') }}" class="btn btn-primary">Add Teacher</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($teachers->hasPages())
        <div class="card-footer">
            <div class="pagination-info">
                Showing {{ $teachers->firstItem() }} to {{ $teachers->lastItem() }} of {{ $teachers->total() }} entries
            </div>
            <div class="pagination">
                {{ $teachers->links('vendor.pagination.custom') }}
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Simple search functionality
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
