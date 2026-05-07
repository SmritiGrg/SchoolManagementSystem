@extends('layouts.student')

@php
    $pageTitle = 'Student Dashboard';
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
    $today = now()->format('l'); // e.g. "Monday"
@endphp

@section('student-content')

<div class="content-header">
    <div class="header-left">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, {{ Auth::user()->name }}!</p>
    </div>
</div>

{{-- Stats --}}
<div class="dashboard-stats">
    <div class="stat-card">
        <h3>Enrolled Courses</h3>
        <p class="stat-number">{{ $enrolledCourses ?? 0 }}</p>
    </div>
    <div class="stat-card">
        <h3>Pending Assignments</h3>
        <p class="stat-number">{{ $pendingAssignments ?? 0 }}</p>
    </div>
    <div class="stat-card">
        <h3>Average Grade</h3>
        <p class="stat-number">{{ $averageGrade ?? 'N/A' }}</p>
    </div>
    <div class="stat-card">
        <h3>Attendance</h3>
        <p class="stat-number">{{ $attendanceRate ?? '0%' }}</p>
    </div>
</div>

{{-- Class Routine --}}
<div class="card" style="margin-top:1.5rem;">
    <div class="card-header" style="display:flex;align-items:center;justify-content:space-between;">
        <h2 style="margin:0;font-size:1rem;font-weight:700;">📅 My Class Routine</h2>
        <span style="font-size:.82rem;color:#6b7280;">Today: <strong style="color:#4f46e5;">{{ $today }}</strong></span>
    </div>

    @php
        $allSlots = collect($routine)->flatten(1)->sortBy('start_time')->unique('start_time')->values();
    @endphp

    @if($allSlots->isEmpty())
        <div class="card-body" style="text-align:center;padding:3rem 2rem;">
            <div style="font-size:2.5rem;margin-bottom:.75rem;">📭</div>
            <p style="font-weight:600;color:#374151;">No routine scheduled yet</p>
            <p style="color:#6b7280;font-size:.9rem;">Your class timetable will appear here once it's set up.</p>
        </div>
    @else

    {{-- Day tabs --}}
    <div style="padding:0 1rem;border-bottom:1px solid #e5e7eb;display:flex;gap:.25rem;overflow-x:auto;">
        @foreach($days as $i => $day)
            @if(collect($routine[$day] ?? [])->isNotEmpty() || $day === $today)
            <button class="routine-tab {{ $day === $today ? 'active' : '' }}"
                onclick="showDay('{{ $day }}')" id="tab-{{ $day }}">
                {{ substr($day,0,3) }}
                @if($day === $today)
                    <span style="width:6px;height:6px;background:#6366f1;border-radius:50%;display:inline-block;margin-left:4px;vertical-align:middle;"></span>
                @endif
            </button>
            @endif
        @endforeach
    </div>

    {{-- Day panels --}}
    @foreach($days as $day)
        <div class="routine-day-panel" id="panel-{{ $day }}" style="{{ $day !== $today ? 'display:none;' : '' }}">
            @php $daySlots = collect($routine[$day] ?? [])->sortBy('start_time'); @endphp
            @if($daySlots->isEmpty())
                <div style="text-align:center;padding:2.5rem;color:#9ca3af;">
                    <p>No classes scheduled for {{ $day }}.</p>
                </div>
            @else
                <div style="padding:1rem;display:flex;flex-direction:column;gap:.75rem;">
                    @foreach($daySlots as $slot)
                    @php $color = $colors[$slot->subject_id % count($colors)]; @endphp
                    <div style="display:flex;gap:1rem;align-items:stretch;">
                        {{-- Time column --}}
                        <div style="min-width:80px;text-align:right;padding-top:.35rem;">
                            <div style="font-size:.78rem;font-weight:700;color:#374151;">{{ substr($slot->start_time,0,5) }}</div>
                            <div style="font-size:.72rem;color:#9ca3af;">{{ substr($slot->end_time,0,5) }}</div>
                        </div>
                        {{-- Slot card --}}
                        <div style="flex:1;background:{{ $color['bg'] }};border-left:4px solid {{ $color['border'] }};border-radius:8px;padding:.75rem 1rem;">
                            <div style="font-weight:700;color:{{ $color['text'] }};font-size:.9rem;margin-bottom:.25rem;">
                                {{ $slot->subject->subject_name }}
                            </div>
                            <div style="font-size:.8rem;color:#6b7280;display:flex;gap:1rem;flex-wrap:wrap;">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:13px;height:13px;display:inline;vertical-align:middle;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    {{ $slot->teacher->user->name ?? 'N/A' }}
                                </span>
                                @if($slot->room)
                                <span>🚪 {{ $slot->room }}</span>
                                @endif
                                <span>⏱ {{ substr($slot->start_time,0,5) }} – {{ substr($slot->end_time,0,5) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach

    @endif
</div>

@push('styles')
<style>
.routine-tab {
    padding:.6rem 1rem;
    border:none;
    background:none;
    font-size:.83rem;
    font-weight:600;
    color:#6b7280;
    cursor:pointer;
    border-bottom:2px solid transparent;
    white-space:nowrap;
    transition:all .15s;
}
.routine-tab:hover { color:#4f46e5; }
.routine-tab.active { color:#4f46e5; border-bottom-color:#6366f1; }
</style>
@endpush

@push('scripts')
<script>
function showDay(day) {
    document.querySelectorAll('.routine-day-panel').forEach(p => p.style.display = 'none');
    document.querySelectorAll('.routine-tab').forEach(t => t.classList.remove('active'));
    const panel = document.getElementById('panel-' + day);
    const tab   = document.getElementById('tab-' + day);
    if (panel) panel.style.display = 'block';
    if (tab)   tab.classList.add('active');
}
</script>
@endpush

@endsection
