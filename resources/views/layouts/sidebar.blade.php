<aside class="sidebar">
    <div class="sidebar-header">
        <h2>{{ $title ?? 'EduFlow' }}</h2>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            @foreach($menuItems as $item)
                <li class="{{ request()->is($item['active'] ?? '') ? 'active' : '' }}">
                    <a href="{{ $item['url'] }}">
                        @if(isset($item['icon']))
                            <i class="{{ $item['icon'] }}"></i>
                        @endif
                        <span>{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</aside>
