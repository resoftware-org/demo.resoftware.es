@extends('theme::layouts.app')

@section('title', 'My Library')

@section('content')

<div
    class="w-full flex flex-col lg:flex-row"
    x-data="reapp_modals()"
    x-init="{}"
    x-cloak
>
    <div class="flex flex-col mx-auto my-6 p-2 w-full lg:w-2/3">
        @empty($courses)
        <div class="w-full mb-6 px-8 py-4 border-b-2 border-b-slate-400">
            <span>Currently, the database does not contain any online courses.</span>
        </div>
        @else
            @foreach($courses as $course)
        <div class="flex flex-col w-full mb-6 px-2 py-4 border-b border-b-slate-200 lg:px-8 bg-transparent hover:bg-slate-200 hover:cursor-pointer active:bg-slate-200">
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
            <div class="flex items-center justify-center mt-4 lg:mt-1">
                <div class="flex hide lg:block lg:w-1/3">
                    <button
                        x-on:click="toggleModalBox('course-details-modal-{{$course->id}}')"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm mt-2 px-2 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button"
                    >
                        Watch Trailer
                    </button>
                </div>
                <div class="flex w-full items-center justify-center mx-auto lg:w-2/3">
                    <div><span class="font-bold">{{ $course->title }}</span>, by {{ $course->user->name }}</div>
                    <div class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent focus:outline-none focus:border-gray-300 ml-3">
                        <img class="w-12 h-12 rounded-full" src="{{ auth()->user()->avatar() . '?' . time() }}" alt="{{ auth()->user()->name }}'s Avatar">
                    </div>
                </div>
            </div>
            <span class="sr-only">Loading...</span>
        </div>

        <!-- Modal box for courses details -->
        <div
            id="course-details-modal-{{$course->id}}"
            style=" background-color: rgba(0, 0, 0, 0.9)"
            class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full"
            x-show.transition.opacity="'course-details-modal-{{$course->id}}' in modalStateById && modalStateById['course-details-modal-{{$course->id}}']"
        >
            <div class="relative w-full max-h-full">
                <div class="p-4 mx-auto relative absolute left-0 right-0 overflow-hidden mt-12">
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Details for "{{$course->title}}"
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" x-on:click="toggleModalBox('course-details-modal-{{$course->id}}')">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="flex flex-col p-6 space-y-6 lg:flex-row">
                        <div class="flex flex-col w-full text-base leading-relaxed text-gray-500 pr-6 dark:text-gray-400 lg:w-1/2 lg:border-r lg:border-r-slate-100">
                            <p class="text-justify">{{$course->description}}</p>

                            <div class="flex flex-col items-center justify-center my-6 lg:flex-row">
                                <div class="w-full lg:w-1/6">
                                    <img class="w-24 h-24 rounded-md" src="/storage/{{$course->image}}" alt="{{$course->title}}" />
                                </div>
                                <div class="w-full lg:w-2/6">
                                    <div class="text-left">
                                        <span>Author: </span>
                                        <span>{{$course->user->name}}</span>
                                    </div>

                                    <div class="text-left">
                                        <span>Category: </span>
                                        <span>{{$course->category->name}}</span>
                                    </div>

                                    <div class="text-left">
                                        <span>Published on {{ $course->created_at->format("d/m/Y") }}</span>
                                    </div>
                                </div>
                            </div>

                            <p class="text-justify">
                                You have not yet started this online course. Are you interested in its content? You can 
                                simply <a href="#" class="underline text-blue-400 hover:text-blue-700">Join the Classroom</a> 
                                here and start your new Learning Journey. Our software makes sure that you keep progressing 
                                and will send you reports on a daily basis.
                            </p>
                        </div>
                        <div class="flex flex-col w-full text-base leading-relaxed text-gray-500 px-6 dark:text-gray-400 lg:w-1/2">
                            <div style="padding:56.25% 0 0 0;position:relative;">
                                <iframe
                                    src="https://player.vimeo.com/video/832911001?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479"
                                    frameborder="0"
                                    allow="autoplay; fullscreen; picture-in-picture"
                                    allowfullscreen
                                    style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                    title="Portfolio: dHealth Health2Earn"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Start now</button>
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ask for more information</button>
                    </div>
                </div>
            </div>
        </div>
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
