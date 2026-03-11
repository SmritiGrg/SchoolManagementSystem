@extends('layouts.admin')

@php 
    $pageTitle = 'User Management'; 
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <h1 class="page-title">Users</h1>
        <p class="page-subtitle">Manage all users in the system</p>
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
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search users..." class="search-input">
            <span class="search-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="search-icon-svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </span>
        </div>
        <div class="filter-group">
            <span class="result-count">{{ $users->total() }} users found</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="user-info">
                                <span class="user-name">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge badge-danger">Admin</span>
                            @elseif($user->role == 'teacher')
                                <span class="badge badge-info">Teacher</span>
                            @elseif($user->role == 'student')
                                <span class="badge badge-success">Student</span>
                            @else
                                <span class="badge badge-secondary">{{ ucfirst($user->role) }}</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#view-modal-{{ $user->id }}" class="btn-action btn-view" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-icon">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </a>

                                <!-- View Modal -->
                                <div id="view-modal-{{ $user->id }}" class="modal">
                                    <div class="modal-overlay">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>User Details</h3>
                                                <a href="#" class="modal-close">&times;</a>
                                            </div>
                                            <div class="modal-body">
                                                <div style="padding: 1rem;">
                                                    <p><strong>Name:</strong> {{ $user->name }}</p>
                                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                                    <p><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                                                    <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                                                    <p><strong>Created:</strong> {{ $user->created_at->format('M d, Y h:i A') }}</p>
                                                    <p><strong>Updated:</strong> {{ $user->updated_at->format('M d, Y h:i A') }}</p>
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
                        <td colspan="7" class="empty-state">
                            <div class="empty-content">
                                <span class="empty-icon">👥</span>
                                <h3>No users found</h3>
                                <p>No users available in the system</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="card-footer">
            <div class="pagination-info">
                Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries
            </div>
            <div class="pagination">
                {{ $users->links('vendor.pagination.custom') }}
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