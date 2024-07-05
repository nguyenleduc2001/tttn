@if (isset($checksub) && $checksub)
    @if (isset($row_menu) && $row_menu)
        <li class="d-none d-xl-inline-block nav-item has-childs has-mega">
            <a class="nav-link" href="{{ route('slug.index', ['slug' => $row_menu->link]) }}"
                title="{{ $row_menu->name }}">{{ $row_menu->name }}</a>
            @foreach ($list_menu1 as $row_menu1)
                <x-sub2-main-menu :rowmenu1="$row_menu1" />
            @endforeach
        </li>
    @endif
@else
    <li class="d-none d-xl-inline-block nav-item has-childs has-mega">
        <a class="nav-link" href="{{ route('slug.index', ['slug' => $row_menu->link]) }}"
            title="{{ $row_menu->name }}">{{ $row_menu->name }}</a>
    </li>
@endif
