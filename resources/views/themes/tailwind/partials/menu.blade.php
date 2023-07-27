
@foreach ($menu->items as $menu_item)
    @php
        // build href property from URL or ROUTE
        $href = !empty($menu_item->url) 
            ? $menu_item->url
            : (!empty($menu_item->route)
            ? route($menu_item->route)
            : '#');

        // set active if necessary
        $active = Request::is($href)
            ? "active-nav-link"
            : "";
    @endphp

<a href="{{ $href }}" class="{{ $classes }} {{ $active }}">
    {{ $menu_item->title }}
</a>
@endforeach
