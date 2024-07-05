<nav class="navbar navbar-main navbar-expand-lg border-bottom">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            
        </button>

        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                @foreach ($list_menu as $menu)
                    <li class="nav-item {{ $menu->submenu->isNotEmpty() ? 'dropdown' : '' }}">
                        <a class="nav-link {{ $menu->submenu->isNotEmpty() ? 'dropdown-toggle' : '' }}"
                            href="{{ $menu->link ?? '#' }}"
                            {{ $menu->submenu->isNotEmpty() ? 'data-toggle=dropdown' : '' }}>
                            {{ $menu->name }}
                        </a>
                        @if ($menu->submenu->isNotEmpty())
                            <div class="dropdown-menu">
                                @foreach ($menu->submenu as $submenu)
                                    <a class="dropdown-item" href="{{ $submenu->link }}">{{ $submenu->name }}</a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item">
                   <a class="navbar-brand " href="http://localhost/TTTN-Nguyenleduc-0018/public/">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">English</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Russian</a>
                        <a class="dropdown-item" href="#">French</a>
                        <a class="dropdown-item" href="#">Spanish</a>
                        <a class="dropdown-item" href="#">Chinese</a>
                    </div>
                </li>
            </ul>
        </div>
    </div> 
</nav>
