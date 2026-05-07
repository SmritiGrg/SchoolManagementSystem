@extends('layouts.admin')

@php $pageTitle = 'Class Routine'; @endphp

@section('admin-content')

<div class="content-header">
    <div class="header-left">
        <h1 class="page-title">Class Routine</h1>
        <p class="page-subtitle">Weekly timetable for each class</p>
    </div>
    @if($selectedClass)
    <div class="header-right">
        <a href="{{ route('admin.routine.create', ['class_id' => $selectedClass->id]) }}" class="btn btn-primary">
            <span class="btn-icon">+</span> Add Slot
        </a>
    </div>
    @endif
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

{{-- Class Selector --}}
<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-body" style="padding:1.25rem;">
        <form method="GET" action="{{ route('admin.routine.index') }}" style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
            <label style="font-weight:600;color:#374151;white-space:nowrap;">Select Class:</label>
            <select name="class_id" class="filter-select" style="min-width:220px;" onchange="this.form.submit()">
                <option value="">-- Choose a class --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ optional($selectedClass)->id == $class->id ? 'selected' : '' }}>
                        {{ $class->class_name }}{{ $class->section ? ' "'.$class->section.'"' : '' }} — {{ $class->academic_year }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

@if(!$selectedClass)
    <div class="card">
        <div class="card-body" style="text-align:center;padding:4rem 2rem;">
            <div style="font-size:3rem;margin-bottom:1rem;">📅</div>
            <h3 style="color:#374151;margin-bottom:.5rem;">Select a Class</h3>
            <p style="color:#6b7280;">Choose a class above to view or manage its weekly routine.</p>
        </div>
    </div>
@else

{{-- Timetable Grid --}}
@php
    $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
    $colors = [
        0 => ['bg'=>'#ede9fe','border'=>'#7c3aed','text'=>'#5b21b6'],
        1 => ['bg'=>'#dbeafe','border'=>'#2563eb','text'=>'#1e40af'],
        2 => ['bg'=>'#dcfce7','border'=>'#16a34a','text'=>'#166534'],
        3 => ['bg'=>'#fef9c3','border'=>'#ca8a04','text'=>'#854d0e'],
        4 => ['bg'=>'#fee2e2','border'=>'#dc2626','text'=>'#991b1b'],
        5 => ['bg'=>'#fce7f3','border'=>'#db2777','text'=>'#9d174d'],
        6 => ['bg'=>'#e0f2fe','border'=>'#0284c7','text'=>'#075985'],
    ];
    // Collect all unique time slots across all days for row headers
    $allSlots = collect($routine)->flatten(1)->sortBy('start_time')->unique('start_time')->values();
@endphp

<div class="routine-wrapper">
    <div class="routine-header-bar">
        <div class="routine-class-info">
            <span class="routine-class-name">
                {{ $selectedClass->class_name }}{{ $selectedClass->section ? ' "'.$selectedClass->section.'"' : '' }}
            </span>
            <span class="routine-academic-year">{{ $selectedClass->academic_year }}</span>
            @if($selectedClass->classTeacher)
                <span class="routine-teacher-badge">
                    Class Teacher: {{ $selectedClass->classTeacher->user->name }}
                </span>
            @endif
        </div>
        <a href="{{ route('admin.routine.create', ['class_id' => $selectedClass->id]) }}" class="btn btn-primary btn-sm">
            <span>+</span> Add Slot
        </a>
    </div>

    <div class="routine-grid-scroll">
        <table class="routine-table">
            <thead>
                <tr>
                    <th class="routine-th-time">Time</th>
                    @foreach($days as $day)
                        <th class="routine-th-day">{{ $day }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($allSlots as $slot)
                @php $timeLabel = substr($slot->start_time,0,5).' - '.substr($slot->end_time,0,5); @endphp
                <tr>
                    <td class="routine-td-time">{{ $timeLabel }}</td>
                    @foreach($days as $day)
                        @php
                            $entry = collect($routine[$day] ?? [])->first(fn($r) => $r->start_time === $slot->start_time);
                            $ci = $entry ? (array_search($entry->subject->subject_name, array_column(iterator_to_array($allSlots->pluck('subject.subject_name')->unique()->values()), null)) % count($colors)) : null;
                            $color = $entry ? $colors[$entry->subject_id % count($colors)] : null;
                        @endphp
                        <td class="routine-td-cell">
                            @if($entry)
                                <div class="routine-slot" style="background:{{ $color['bg'] }};border-left:4px solid {{ $color['border'] }};">
                                    <div class="routine-slot-subject" style="color:{{ $color['text'] }};">
                                        {{ $entry->subject->subject_name }}
                                    </div>
                                    <div class="routine-slot-teacher">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:12px;height:12px;display:inline;vertical-align:middle;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        {{ $entry->teacher->user->name ?? 'N/A' }}
                                    </div>
                                    @if($entry->room)
                                        <div class="routine-slot-room">🚪 {{ $entry->room }}</div>
                                    @endif
                                    <div class="routine-slot-actions">
                                        <a href="{{ route('admin.routine.edit', $entry) }}" class="routine-action-btn edit" title="Edit">✏️</a>
                                        <a href="#del-{{ $entry->id }}" class="routine-action-btn delete" title="Delete">🗑️</a>
                                    </div>

                                    {{-- Delete modal --}}
                                    <div id="del-{{ $entry->id }}" class="modal">
                                        <div class="modal-overlay">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3>Delete Slot</h3>
                                                    <a href="#" class="modal-close">&times;</a>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-icon-warning">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                                        </svg>
                                                    </div>
                                                    <p class="modal-text">Delete <strong>{{ $entry->subject->subject_name }}</strong> on <strong>{{ $day }}</strong> at <strong>{{ substr($entry->start_time,0,5) }}</strong>?</p>
                                                    <p class="modal-subtext">This action cannot be undone.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-secondary">Cancel</a>
                                                    <form action="{{ route('admin.routine.destroy', $entry) }}" method="POST" style="display:inline;">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="routine-empty-cell">—</div>
                            @endif
                        </td>
                    @endforeach
                </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:3rem;color:#9ca3af;">
                            <div style="font-size:2.5rem;margin-bottom:.75rem;">📭</div>
                            <p style="font-weight:600;color:#374151;">No routine slots yet</p>
                            <p style="margin-bottom:1rem;">Start building the timetable for this class.</p>
                            <a href="{{ route('admin.routine.create', ['class_id' => $selectedClass->id]) }}" class="btn btn-primary">Add First Slot</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endif

@push('styles')
<style>
.routine-wrapper { background:#fff; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,.08); overflow:hidden; }
.routine-header-bar { display:flex; align-items:center; justify-content:space-between; padding:1.25rem 1.5rem; border-bottom:1px solid #e5e7eb; background:#f9fafb; flex-wrap:wrap; gap:.75rem; }
.routine-class-name { font-size:1.1rem; font-weight:700; color:#111827; margin-right:.5rem; }
.routine-academic-year { font-size:.85rem; color:#6b7280; background:#e5e7eb; padding:2px 10px; border-radius:20px; margin-right:.5rem; }
.routine-teacher-badge { font-size:.8rem; color:#4f46e5; background:#ede9fe; padding:2px 10px; border-radius:20px; }
.routine-grid-scroll { overflow-x:auto; }
.routine-table { width:100%; border-collapse:collapse; min-width:700px; }
.routine-th-time { width:110px; padding:.75rem 1rem; background:#f3f4f6; font-size:.78rem; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.05em; border-bottom:2px solid #e5e7eb; white-space:nowrap; }
.routine-th-day { padding:.75rem 1rem; background:#f3f4f6; font-size:.82rem; font-weight:700; color:#374151; text-align:center; border-bottom:2px solid #e5e7eb; border-left:1px solid #e5e7eb; }
.routine-td-time { padding:.75rem 1rem; font-size:.78rem; font-weight:600; color:#6b7280; white-space:nowrap; border-bottom:1px solid #f3f4f6; background:#fafafa; }
.routine-td-cell { padding:.5rem; border-bottom:1px solid #f3f4f6; border-left:1px solid #f3f4f6; vertical-align:top; min-width:130px; }
.routine-slot { border-radius:8px; padding:.6rem .75rem; position:relative; }
.routine-slot-subject { font-size:.82rem; font-weight:700; margin-bottom:.25rem; }
.routine-slot-teacher { font-size:.75rem; color:#6b7280; margin-bottom:.2rem; }
.routine-slot-room { font-size:.72rem; color:#9ca3af; }
.routine-slot-actions { display:none; position:absolute; top:4px; right:4px; gap:4px; }
.routine-slot:hover .routine-slot-actions { display:flex; }
.routine-action-btn { font-size:.75rem; text-decoration:none; padding:2px 5px; border-radius:4px; background:rgba(255,255,255,.8); }
.routine-empty-cell { text-align:center; color:#d1d5db; font-size:1rem; padding:.5rem; }
</style>
@endpush

@endsection
