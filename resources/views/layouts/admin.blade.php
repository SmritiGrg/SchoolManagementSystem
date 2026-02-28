@extends('layouts.dashboard')

@php
    $pageTitle = $pageTitle ?? 'Admin Panel';
    $sidebarTitle = 'Admin Panel';
    $menuItems = [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard'), 'icon' => 'icon-dashboard', 'active' => 'admin/dashboard'],
        ['label' => 'Users', 'url' => '#', 'icon' => 'icon-users', 'active' => 'admin/users*'],
        ['label' => 'Teachers', 'url' => '#', 'icon' => 'icon-teacher', 'active' => 'admin/teachers*'],
        ['label' => 'Students', 'url' => '#', 'icon' => 'icon-student', 'active' => 'admin/students*'],
        ['label' => 'Courses', 'url' => '#', 'icon' => 'icon-courses', 'active' => 'admin/courses*'],
        ['label' => 'Subjects', 'url' => route('admin.subject.list'), 'icon' => 'icon-subjects', 'active' => 'admin/subject*'],
        ['label' => 'Reports', 'url' => '#', 'icon' => 'icon-reports', 'active' => 'admin/reports*'],
        ['label' => 'Settings', 'url' => '#', 'icon' => 'icon-settings', 'active' => 'admin/settings*'],
    ];
@endphp

@section('content')
    @yield('admin-content')
@endsection