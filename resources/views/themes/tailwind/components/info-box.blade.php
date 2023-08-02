@php
    $message = isset($message) ? $message : "No message set";
@endphp

<div class="flex flex-row items-start mt-3 p-4 rounded-lg border border-orange-700 bg-orange-100 sm:hidden">
    <div><span class="text-2xl i-mdi-info-outline"></span></div>
    <p class="text-sm text-justify">&nbsp;{{$message}}</p>
</div>
