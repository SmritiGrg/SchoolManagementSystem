@extends('layouts.teacher')

@php
    $pageTitle = 'Teacher Dashboard';
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
    $today = now()->format('l');
@endphp

@section('teacher-content')

<div class="content-header">
    <div class="header-left">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Welcome back, {{ Auth::user()->name }}!</p>
    </div>
</div>

{{-- Stats --}}
<div class="dashboard-stats">
    <div class="stat-card">
        <h3>My Courses</h3>
        <p class="stat-number">{{ $totalCourses ?? 0 }}</p>
    </div>
    <div class="stat-card">
        <h3>Total Students</h3>
        <p class="stat-number">{{ $totalStudents ?? 0 }}</p>
    </div>
    <div class="stat-card">
        <h3>Pending Grading</h3>
        <p class="stat-number">{{ $pendingGrading ?? 0 }}</p>
    </div>
    <div class="stat-card">
        <h3>Upcoming Classes</h3>
        <p class="stat-number">{{ $upcomingClasses ?? 0 }}</p>
    </div>
</div>

{{-- Class Routine --}}
<div class="card" style="margin-top:1.5rem;">
    <div class="card-header" style="display:flex;align-items:center;justify-content:space-between;">
        <h2 style="margin:0;font-size:1rem;font-weight:700;">📅 My Teaching Schedule</h2>
        <span style="font-size:.82rem;color:#6b7280;">Today: <strong style="color:#4f46e5;">{{ $today }}</strong></span>
    </div>

    @php
        $allSlots = collect($routine)->flatten(1)->sortBy('start_time')->unique('start_time')->values();
    @endphp

    @if($allSlots->isEmpty())
        <div class="card-body" style="text-align:center;padding:3rem 2rem;">
            <div style="font-size:2.5rem;margin-bottom:.75rem;">📭</div>
            <p style="font-weight:600;color:#374151;">No schedule assigned yet</p>
            <p style="color:#6b7280;font-size:.9rem;">Your teaching timetable will appear here once it's set up by the admin.</p>
        </div>
    @else

    {{-- Day tabs --}}
    <div style="padding:0 1rem;border-bottom:1px solid #e5e7eb;display:flex;gap:.25rem;overflow-x:auto;">
        @foreach($days as $day)
            @php $hasSlots = collect($routine[$day] ?? [])->isNotEmpty(); @endphp
            @if($hasSlots || $day === $today)
            <button class="routine-tab {{ $day === $today ? 'active' : '' }}"
                onclick="showDay('{{ $day }}')" id="tab-{{ $day }}">
                {{ substr($day, 0, 3) }}
                @if($day === $today)
                    <span style="width:6px;height:6px;background:#6366f1;border-radius:50%;display:inline-block;margin-left:4px;vertical-align:middle;"></span>
                @endif
                @if($hasSlots)
                    <span style="font-size:.7rem;background:#e0e7ff;color:#4f46e5;border-radius:10px;padding:1px 6px;margin-left:4px;">{{ collect($routine[$day])->count() }}</span>
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
                        <div style="min-width:80px;text-align:right;padding-top:.35rem;flex-shrink:0;">
                            <div style="font-size:.78rem;font-weight:700;color:#374151;">{{ substr($slot->start_time,0,5) }}</div>
                            <div style="font-size:.72rem;color:#9ca3af;">{{ substr($slot->end_time,0,5) }}</div>
                        </div>
                        {{-- Slot card --}}
                        <div style="flex:1;background:{{ $color['bg'] }};border-left:4px solid {{ $color['border'] }};border-radius:8px;padding:.75rem 1rem;">
                            <div style="font-weight:700;color:{{ $color['text'] }};font-size:.9rem;margin-bottom:.3rem;">
                                {{ $slot->subject->subject_name }}
                            </div>
                            <div style="font-size:.8rem;color:#6b7280;display:flex;gap:1rem;flex-wrap:wrap;">
                                {{-- Class badge --}}
                                <span style="background:{{ $color['border'] }};color:#fff;border-radius:6px;padding:1px 8px;font-size:.75rem;font-weight:600;">
                                    {{ $slot->schoolClass->class_name }}{{ $slot->schoolClass->section ? ' "'.$slot->schoolClass->section.'"' : '' }}
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
