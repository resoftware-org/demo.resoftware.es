@php
    $withIcons = isset($withIcons) && $withIcons ?: false;
@endphp

@foreach ($menu->items as $menu_item)
    @php
        // build href property from URL or ROUTE
        $href = !empty($menu_item->url) 
            ? $menu_item->url
            : (!empty($menu_item->route)
            ? route($menu_item->route)
            : '#');

        // set active if necessary
        $active = Request::routeIs($menu_item->route)
            ? "active-nav-link"
            : "";
    @endphp

<a href="{{ $href }}" class="{{ $classes }} {{ $active }}">
    @if ($withIcons === true && $menu_item->icon_class)
        <span class="text-4xl mr-2 i-{{$menu_item->icon_class}} h-8"></span>
    @endif
    <span class="text-lg">{{ __('replay.app.menu.' . $menu_item->title) }}</span>
</a>
@endforeach
