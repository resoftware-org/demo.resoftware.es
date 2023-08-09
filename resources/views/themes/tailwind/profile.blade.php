@extends('theme::layouts.app')

@section('title', __('replay.profile.title', ['name' => $user->titled_name]))

@section('content')

<div
    class="flex flex-col px-8 mx-auto my-6 xl:px-5 lg:flex-row lg:items-start max-w-7xl"
    x-data="reapp_modals()"
    x-init="[]"
    x-cloak
>
    <div class="flex flex-col items-center justify-center w-full px-10 py-16 mb-8 mr-6 bg-white border rounded-lg lg:mb-0 lg:flex-1 lg:w-1/3 border-gray-150">
        <img src="{{ Voyager::image($user->avatar) }}" class="w-24 h-24 border-4 border-gray-200 rounded-full">
        <h2 class="mt-8 text-2xl font-bold">{{ $user->titled_name }}</h2>
        <p class="my-1 font-medium text-wave-blue">{{ '@' . $user->username }}</p>
        <div class="px-3 py-1 my-2 text-xs font-medium text-white bg-wave-600 rounded">{{ $user->role->display_name }}</div>
        <p class="w-3/4 mx-auto mt-3 text-base text-justify text-gray-500">{{ $user->profile('about') }}</p>
    </div>

    <div class="flex flex-col w-full p-10 overflow-hidden bg-white border rounded-lg lg:w-2/3 border-gray-150 lg:flex-2">
        <div class="flex flex-col mt-5 items-start sm:flex-row">
            <div class="w-1/2 pr-4 border-r border-r-gray-200">
                <label for="about" class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.subtitle_about')}}</label>
                <div class="mt-1 text-justify rounded-md sm:py-4">
                    @empty($user->profile('about'))
                        This user has not completed their profile yet.
                    @else
                        {{$user->profile('about')}}
                    @endempty
                </div>
            </div>
            <div class="w-1/2 ml-4">
                <label class="block text-sm leading-5 text-gray-700">{{__('replay.profile.subtitle_details')}}</label>
                <div class="mt-1 rounded-md items-start sm:py-4">
                    <div>
                        @php $date_of_birth = (new Carbon\Carbon($user->profile('date_of_birth')))->format("d/m/Y"); @endphp
                        <span>{{__('replay.profile.date_of_birth')}}: {{$date_of_birth}}</span>
                    </div>
                </div>
                <div class="mt-1 rounded-md items-start">
                    <label class="block text-sm leading-5 text-gray-700">{{__('replay.profile.subtitle_social')}}</label>
                    <div class="flex flex-row mt-5">
                    @if ($user->profile('website_url'))
                        @php $website_url = external_url($user->profile('website_url')); @endphp
                        <a href="{{$website_url}}" class="py-1 px-2 text-2xl" title="Website" target="_blank">
                            <span class="i-mdi-web"></span>
                        </a>
                    @endif
                    @if ($user->profile('facebook_url'))
                        @php $facebook_url = external_url($user->profile('facebook_url')); @endphp
                        <a href="{{$facebook_url}}" class="py-1 px-2 text-2xl text-blue-600" title="Facebook" target="_blank">
                            <span class="i-mdi-facebook"></span>
                        </a>
                    @endif
                    @if ($user->profile('instagram_url'))
                        @php $instagram_url = external_url($user->profile('instagram_url')); @endphp
                        <a href="{{$instagram_url}}" class="py-1 px-2 text-2xl text-pink-600" title="Instagram" target="_blank">
                            <span class="i-mdi-instagram"></span>
                        </a>
                    @endif
                    @if ($user->profile('twitter_url'))
                        @php $twitter_url = external_url($user->profile('twitter_url')); @endphp
                        <a href="{{$twitter_url}}" class="py-1 px-2 text-2xl text-cyan-600" title="Twitter" target="_blank">
                            <span class="i-mdi-twitter"></span>
                        </a>
                    @endif
                    @if ($user->profile('twitch_url'))
                        @php $twitch_url = external_url($user->profile('twitch_url')); @endphp
                        <a href="{{$twitch_url}}" class="py-1 px-2 text-2xl text-violet-600" title="Twitch" target="_blank">
                            <span class="i-mdi-twitch"></span>
                        </a>
                    @endif
                    @if ($user->profile('youtube_url'))
                        @php $youtube_url = external_url($user->profile('youtube_url')); @endphp
                        <a href="{{$youtube_url}}" class="py-1 px-2 text-2xl text-red-600" title="YouTube" target="_blank">
                            <span class="i-mdi-youtube"></span>
                        </a>
                    @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <label class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.subtitle_courses')}}</label>
            <div class="mt-1 rounded-md">

            @if ($user->courses->count())
                <ul role="list" class="h-full">
                @foreach ($user->courses as $course)
                    <li
                        x-on:click="toggleModalBox('course-details-modal-{{$course->id}}')"
                        class="px-3 py-3 sm:py-4 rounded-lg hover:cursor-pointer hover:bg-gray-100"
                    >
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img
                                    class="w-8 h-8 rounded-md"
                                    src="/storage/{{$course->image}}"
                                    alt="Featured image of {{$course->title}}">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    {{$course->title}}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    with {{$user->name}}
                                </p>
                            </div>
                            <div class="grid grid-flow-col gap-10 items-center justify-center text-xl text-gray-900">
                                <div>
                                    <span class="i-mdi-calendar"></span>&nbsp;<span class="text-lg">{{$course->schedules->count()}}</span>
                                </div>
                                <div>
                                    <span class="i-mdi-account-group"></span>&nbsp;<span class="text-lg">{{$course->reservations->count()}}</span>
                                </div>
                            </div>
                        </div>

                        @include("theme::modals.read-event", [
                            "xShow" => "'course-details-modal-" . $course->id . "' in modalStateById && modalStateById['course-details-modal-" . $course->id . "']",
                            "xVar"  => "modalStateById['course-details-modal-" . $course->id . "']",
                            "course" => $course,
                        ])
                    </li>
                @endforeach
                </ul>
            @else
                This user has not published online courses yet.
            @endif
            </div>
        </div>

        <div class="mt-5">
            <label class="block text-sm font-medium leading-5 text-gray-700">{{__('replay.profile.subtitle_courses_taken')}}</label>
            <div class="mt-1 rounded-md">

            @if ($user->attendances->count())
                <ul role="list" class="h-full">
                @foreach ($user->distinct_courses_taken() as $course)
                    <li
                        x-on:click="toggleModalBox('course-details-modal-{{$course->id}}')"
                        class="px-3 py-3 sm:py-4 rounded-lg hover:cursor-pointer hover:bg-gray-100"
                    >
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img
                                    class="w-8 h-8 rounded-md"
                                    src="/storage/{{$course->image}}"
                                    alt="Featured image of {{$course->title}}">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">
                                    {{$course->title}}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    with {{$course->user->name}}
                                </p>
                            </div>
                            <div class="grid grid-flow-col items-center justify-center text-base text-gray-900">
                                <div>
                                    <span class="i-mdi-account-group"></span>&nbsp;<span class="text-lg">{{$course->reservations->count()}}</span>
                                </div>
                            </div>
                        </div>

                        @include("theme::modals.read-event", [
                            "xShow" => "'course-details-modal-" . $course->id . "' in modalStateById && modalStateById['course-details-modal-" . $course->id . "']",
                            "xVar"  => "modalStateById['course-details-modal-" . $course->id . "']",
                            "course" => $course,
                        ])
                    </li>
                @endforeach
                </ul>
            @else
                This user has not started their learning journey yet.
            @endif
            </div>
        </div>
    </div>

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
