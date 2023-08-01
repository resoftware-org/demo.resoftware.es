@extends('theme::layouts.app')

@section('title', 'My Library')

@section('content')

<!-- FEATURED TEACHERS -->

<div
    class="w-full flex flex-col lg:flex-row"
    x-data="reapp_modals()"
    x-init="[]"
    x-cloak
>
    <div class="flex flex-col mx-auto my-6 p-2 w-full lg:w-2/3">
        @empty($courses)
        <div class="w-full mb-6 px-8 py-4 border-b-2 border-b-slate-400">
            <span>Currently, the database does not contain any online courses.</span>
        </div>
        @else
            @foreach($courses as $course)
        <div
            x-on:click="toggleModalBox('course-details-modal-{{$course->id}}')"
            class="flex flex-col w-full mb-6 px-2 py-4 border-b border-b-slate-200 lg:px-8 bg-transparent hover:bg-slate-200 hover:cursor-pointer active:bg-slate-200"
        >
            <div class="flex flex-row items-start lg:items-center">
                <div class="flex flex-col mt-4 w-1/3 lg:w-1/6">
                    <img class="w-24 h-24 rounded-md" src="/storage/{{$course->image}}" alt="{{$course->title}}" />
                </div>
                <div class="flex w-2/3 items-center justify-center mt-4 mx-auto lg:w-5/6">
                    <div class="text-center max-w-[640px] mb-2.5 mx-auto">
                        {{$course->excerpt}}
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center lg:flex-row lg:mt-1">
                <div class="flex w-full lg:w-1/3">
                    <button
                        x-on:click="toggleModalBox('course-details-modal-{{$course->id}}'); event.stopPropagation();"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mt-1 lg:mt-2 px-1 lg:px-2 py-1 lg:py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button"
                    >
                        <span>Watch Trailer</span>
                    </button>
                </div>
                <div class="flex w-full mt-2 lg:mt-0 items-center justify-center mx-auto lg:w-2/3">
                    <div><span class="text-xl font-bold">{{ $course->title }}</span>, by {{ $course->user->name }}</div>
                    <div class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent focus:outline-none focus:border-gray-300 ml-3">
                        <img class="w-12 h-12 rounded-full" src="{{ auth()->user()->avatar() . '?' . time() }}" alt="{{ auth()->user()->name }}'s Avatar">
                    </div>
                </div>
            </div>
            <span class="sr-only">Loading...</span>
        </div>

                @include("theme::modals.read-event", [
                    "xShow" => "'course-details-modal-" . $course->id . "' in modalStateById && modalStateById['course-details-modal-" . $course->id . "']",
                    "course" => $course,
                ])

            @endforeach
        @endempty
    </div>

    @include("theme::partials.sidebar")
</div>

<script>
function reapp_modals() {
    return {
        modalStateById: {},

        toggleModalBox(id) {
            // toggle the modal box or init
            this.modalStateById[id] = id in this.modalStateById
                ? !this.modalStateById[id]
                : true;
        }
    };
}
</script>

<script src="https://player.vimeo.com/api/player.js"></script>

@endsection
