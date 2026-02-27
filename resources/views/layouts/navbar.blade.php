<nav class="navbar">
    <div class="navbar-left">
        <button class="sidebar-toggle" id="sidebarToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <h1>{{ $pageTitle ?? 'Dashboard' }}</h1>
    </div>
    
    <div class="navbar-right">
        <div class="user-menu">
            <span class="user-name">{{ Auth::user()->name ?? 'User' }}</span>
            <div class="user-dropdown">
                <a href="#">Profile</a>
                <a href="#">Settings</a>
                @if(Route::has('logout'))
                    <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @else
                    <a href="#" onclick="alert('Logout route not configured'); return false;">Logout</a>
                @endif
            </div>
        </div>
    </div>
</nav>
