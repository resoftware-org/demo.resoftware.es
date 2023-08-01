@php
    $title = isset($title) ? $title : "No title set";
    $subtitle = isset($subtitle) ? $subtitle : "No subtitle set";
    $cta_link = isset($link) ? $link : "#";
    $cta_text = isset($cta_text) ? $cta_text : "No text set";
    $cta_external = isset($cta_external) && $cta_external ? 'target="_blank"' : "";

    $css_lg_m = !isset($position) || $position === "left" ? "mr-3" : "ml-3";
    $extra_css = isset($extra_css) ? $extra_css : ""
@endphp

<div class="flex flex-col flex-1 justify-start overflow-hidden mb-3 bg-white border rounded-lg lg:{{$css_lg_m}} border-gray-150 {{$extra_css}}">
    <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
        <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
            {!! $icon !!}
        </div>
        <div class="relative flex-1">
            <h3 class="text-lg font-medium leading-6 text-gray-700">
                {{$title}}
            </h3>
            <p class="text-sm leading-5 text-gray-500 mt">
                {{$subtitle}}
            </p>
        </div>
    </div>
    <div class="relative p-5">

    @if ($type === "text")
        @foreach (($content ?? []) as $paragraph)
        <p class="text-base leading-loose text-gray-500">{{$paragraph}}</p>
        @endforeach
    @endif
        <br />
        <span class="inline-flex mt-5 rounded-md shadow-sm">
            <a href="{{ $cta_link }}" {{$cta_external}} class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50">
                {{$cta_text}}
            </a>
        </span>
    </div>
</div>