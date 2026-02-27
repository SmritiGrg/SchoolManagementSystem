<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageTitle ?? 'Dashboard' }} - EduFlow</title>
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    @stack('styles')
</head>
<body>
    <div class="dashboard-container">
        @include('layouts.sidebar', ['title' => $sidebarTitle ?? 'EduFlow', 'menuItems' => $menuItems ?? []])
        
        <div class="main-content">
            @include('layouts.navbar', ['pageTitle' => $pageTitle ?? 'Dashboard'])
            
            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
