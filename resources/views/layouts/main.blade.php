<!doctype html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'EduFlow - School Management System')</title>

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  {{-- Vite --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Your custom css --}}
  <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
</head>

<body class="h-full gradient-bg text-white overflow-auto">

  @include('layouts.nav')
  <main>
    @yield('container')
  </main>

  @include('layouts.footer')
</body>
</html>