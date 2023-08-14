@extends('theme::layouts.app')

@section('title', 'Calendar')

@section('content')

<!-- reApp Calendar -->
<div
    class="w-full flex flex-col px-4 mx-auto my-3 lg:flex-row max-w-7xl sm:px-8 sm:my-0 xl:px-5"
    x-data="reapp_calendar()"
    x-init="[initializeDate()]"
    x-cloak
>
    <!-- source: https://tailwindcomponents.com/component/calendar-ui-with-tailwindcss-and-alpinejs -->
    <div class="antialiased sans-serif bg-gray-100 w-full lg:w-4/6">
        <div class="flex flex-col items-center justify-center mb-4 sm:justify-between sm:flex-row">
            <h2 class="text-xl font-bold leading-none text-gray-900">{{__('replay.calendar.title')}}</h2>

            @include("theme::components.info-box", [
                "message" => __('replay.calendar.intro'),
            ])
        </div>
        <div>
            <!-- Calendar UI -->
            <div class="container py-2">
                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <!-- Month + Controls -->
                    <div class="flex items-center justify-between py-2 px-6">
                        <div>
                            <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                            <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                        </div>
                        <div class="border rounded-lg px-1" style="padding-top: 2px;">
                            <!-- Left Arrow -->
                            <button 
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center" 
                                :class="{'cursor-not-allowed opacity-25': month == 0 }"
                                :disabled="month == 0 ? true : false"
                                @click="month--; countDaysInMonth()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </button>
                            <div class="border-r inline-flex h-6"></div>		
                            <!-- Right Arrow -->
                            <button 
                                type="button"
                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1" 
                                :class="{'cursor-not-allowed opacity-25': month == 11 }"
                                :disabled="month == 11 ? true : false"
                                @click="month++; countDaysInMonth()">
                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- End Month + Controls -->

                    <!-- Calendar Days -->
                    <div class="-mx-1 -mb-1">

                        <!-- Days Header -->
                        <div class="flex flex-wrap mb-[-20px] sm:mb-[-40px]">
                            <template x-for="(day, index) in DAYS" :key="index">	
                                <div style="width: 14.26%" class="px-2 py-2">
                                    <div
                                        x-text="day" 
                                        class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center"></div>
                                </div>
                            </template>
                        </div>

                        <!-- Days Boxes -->
                        <div class="flex flex-wrap border-t border-l">
                            <template x-for="blankday in days_blank">
                                <div 
                                    style="width: 14.28%;"
                                    class="text-center border-r border-b px-4 pt-2 h-[40px] lg:h-[100px] 2xl:h-[120px]"
                                ></div>
                            </template>
                            <template x-for="(date, dateIndex) in days_of_month" :key="dateIndex">	
                                <div style="width: 14.28%;" class="px-2 pt-2 border-r border-b relative h-[40px] lg:px-4 lg:h-[100px] 2xl:h-[120px]">
                                    <div
                                        @click="showEventModal(date)"
                                        x-text="date"
                                        class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                                        :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"	
                                    ></div>
                                    <div class="flex flex-row overflow-y-auto mt-1 w-full h-[30px]">
                                        <div
                                            x-show="0 < events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() && e.event_theme === 'blue' ).length"
                                            class="px-2 py-1 ml-1 mt-7 overflow-hidden border rounded-full w-[40px] max-w-[40px] border-blue-200 text-blue-800 bg-blue-100 sm:rounded-lg sm:mt-1"
                                        >
                                            <p x-text="events.filter(e => new Date(e.event_date).toDateString() === new Date(year, month, date).toDateString() && e.event_theme === 'blue').length" class="hidden text-sm truncate leading-tight sm:block w-[40px]"></p>
                                        </div>
                                        <div
                                            x-show="0 < events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() && e.event_theme === 'red' ).length"
                                            class="px-2 py-1 ml-1 mt-7 overflow-hidden border rounded-full w-[40px] max-w-[40px] border-red-200 text-red-800 bg-red-100 sm:rounded-lg sm:mt-1"
                                        >
                                            <p x-text="events.filter(e => new Date(e.event_date).toDateString() === new Date(year, month, date).toDateString() && e.event_theme === 'red').length" class="hidden text-sm truncate leading-tight sm:block w-[40px]"></p>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <!-- End Calendar Days -->
                </div>
            </div> <!-- End Calendar UI -->

            @include("theme::modals.add-event", [
                "xShow" => "form.isOpen", // see reapp_calendar()
            ])

        </div>
    </div>

    <!-- Sidebar Right -->
    <div class="relative px-6 mt-10 text-gray-500 w-full lg:mt-0 lg:w-2/6 max-h-[580px] overflow-y-hidden">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold leading-none text-gray-900">{{__('replay.calendar.sidebar.title')}}</h2>
            <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
            {{__('replay.calendar.sidebar.view_all')}}
            </a>
        </div>

        @php $events = $schedules->merge($reservations)->sortBy("course_opens_at"); @endphp

        <div class="flow-root">

        @if($events->isEmpty())
            <p class="py-6">{{__('replay.calendar.empty_message')}}</p>
        @endempty

        @if (isset($events))
            <ul role="list" class="h-full">

            @foreach ($events->slice(0, 6) as $schedule)
                <li
                    x-show="current_page === 1"
                    x-on:click="toggleModalBox('course-details-modal-{{$schedule->course->id}}')"
                    class="py-3 sm:py-4 border-b border-b-gray-700 hover:cursor-pointer"
                >
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img
                                class="w-8 h-8 rounded-md"
                                src="/storage/{{$schedule->course->image}}"
                                alt="Featured image of {{$schedule->course->title}}">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">
                                {{$schedule->course->title}}
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                with {{$schedule->user->name}}
                            </p>
                        </div>
                        <div class="flex flex-col items-center justify-center text-base text-gray-900">
                            <div class="items-center"><span class="i-mdi-calendar"></span>&nbsp;{{$schedule->course_opens_at->format("d.m")}}</div>
                            <div class="items-center"><span class="i-mdi-clock-outline"></span>&nbsp;{{$schedule->course_opens_at->format("H:i")}}</div>
                        </div>
                    </div>

                    @include("theme::modals.read-event", [
                        "xShow" => "'course-details-modal-" . $schedule->course->id . "' in modalStateById && modalStateById['course-details-modal-" . $schedule->course->id . "']",
                        "xVar"  => "modalStateById['course-details-modal-" . $schedule->course->id . "']",
                        "course" => $schedule->course,
                    ])
                </li>
            @endforeach

            @if ($events->count() > 6)
            @php $page = 2; $i = 0; @endphp
            @foreach ($events->slice(6) as $schedule)
                @if ($i === 6) @php $page++; @endphp @endif
                <li 
                    x-show="current_page === {{$page}}"
                    x-on:click="toggleModalBox('course-details-modal-{{$schedule->course->id}}')"
                    class="py-3 sm:py-4 border-b border-b-gray-700 hover:cursor-pointer"
                >
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img
                                class="w-8 h-8 rounded-md"
                                src="/storage/{{$schedule->course->image}}"
                                alt="Featured image of {{$schedule->course->title}}">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">
                                {{$schedule->course->title}}
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                with {{$schedule->user->name}}
                            </p>
                        </div>
                        <div class="flex flex-col items-center justify-center text-base text-gray-900">
                            <div class="items-center"><span class="i-mdi-calendar"></span>&nbsp;{{$schedule->course_opens_at->format("d.m")}}</div>
                            <div class="items-center"><span class="i-mdi-clock-outline"></span>&nbsp;{{$schedule->course_opens_at->format("H:i")}}</div>
                        </div>
                    </div>

                    @include("theme::modals.read-event", [
                        "xShow" => "'course-details-modal-" . $schedule->course->id . "' in modalStateById && modalStateById['course-details-modal-" . $schedule->course->id . "']",
                        "course" => $schedule->course,
                    ])
                </li>
            @php $i++; @endphp
            @endforeach
            @endif

            </ul>

            @if ($events->count() > 6)
            <div class="flex flex-wrap justify-center mt-6 lg:mt-8">
                <span class="text-base font-medium">{{__('replay.calendar.sidebar.page')}}:</span>
                @for ($i = 0; $i < ($events->count() / 6); $i++)
                    @php $page = $i+1; @endphp
                <span
                    @click="current_page = {{$page}}"
                    class="text-base mx-2 hover:cursor-pointer"
                    :class="{
                        'underline': current_page !== {{$page}},
                        'text-blue-600': current_page !== {{$page}},
                    }"
                >{{$page}}</span>
                @endfor
            </div>
            @endif
        @endif

        </div>
    </div> <!-- End Sidebar Right -->
</div>
<!-- End reApp Calendar -->

<script>
    // list of localized full month names
    const MONTH_NAMES = [
        '{{__("replay.calendar.months.full.01")}}', // January
        '{{__("replay.calendar.months.full.02")}}',
        '{{__("replay.calendar.months.full.03")}}',
        '{{__("replay.calendar.months.full.04")}}',
        '{{__("replay.calendar.months.full.05")}}',
        '{{__("replay.calendar.months.full.06")}}',
        '{{__("replay.calendar.months.full.07")}}',
        '{{__("replay.calendar.months.full.08")}}',
        '{{__("replay.calendar.months.full.09")}}',
        '{{__("replay.calendar.months.full.10")}}',
        '{{__("replay.calendar.months.full.11")}}',
        '{{__("replay.calendar.months.full.12")}}',
    ];

    // list of localized short days names
    const DAYS = [
        '{{__("replay.calendar.days.short.01")}}', // Monday
        '{{__("replay.calendar.days.short.02")}}',
        '{{__("replay.calendar.days.short.03")}}',
        '{{__("replay.calendar.days.short.04")}}',
        '{{__("replay.calendar.days.short.05")}}',
        '{{__("replay.calendar.days.short.06")}}',
        '{{__("replay.calendar.days.short.07")}}',
    ];

    function reapp_calendar() {
        return {
            month: '',
            year: '',
            days_of_month: [],
            days_blank: [],
            current_page: 1,
            modalStateById: {},

            form: {
                isOpen: false,
                title: '',
                date: '',
                theme: '',
            },

            themes: [
                {
                    value: "blue",
                    label: "My courses"
                },
                {
                    value: "red",
                    label: "My reservations"
                }
            ],

            events: [

                @foreach ($schedules as $schedule)
                {
                    event_date: new Date('{{$schedule->course_opens_at}}'),
                    event_title: "{{$schedule->course->title}}",
                    event_theme: "blue"
                },
                @endforeach

                @foreach ($reservations as $booking)
                {
                    event_date: new Date('{{$booking->course_opens_at}}'),
                    event_title: "{{$booking->course->title}}",
                    event_theme: "red"
                },
                @endforeach

            ],

            initializeDate() {
                let today = new Date();
                this.month = '{{$month-1}}'; // JS months are indexed
                this.year = '{{$year}}';

                this.datepickerValue = new Date(this.year, this.month, 1).toDateString();

                // also initialize days boxes
                this.initializeBoxes();
            },

            initializeBoxes() {
                // count of days in current month
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                // find out day of week for 1st of month
                let dayOfWeek = new Date(this.year, this.month).getDay();

                // we use Monday as 1st day of week (JS uses Sunday)
                if (dayOfWeek === 0) dayOfWeek = 6;
                else dayOfWeek--;

                // empty boxes before 1st of month
                this.days_blank = [];
                for (var i = 1; i <= dayOfWeek; i++) {
                    this.days_blank.push(i);
                }

                // fillable days of the month
                this.days_of_month = [];
                for (var i = 1; i <= daysInMonth; i++) {
                    this.days_of_month.push(i);
                }
            },

            isToday(date) {
                const today = new Date();
                const d = new Date(this.year, this.month, date);

                return today.toDateString() === d.toDateString() ? true : false;
            },

            showEventModal(date) {
                // open the modal
                this.form.isOpen = true;
                this.form.date = new Date(this.year, this.month, date).toDateString();
            },

            addEvent() {
                if (this.form.title == '') {
                    return;
                }

                this.events.push({
                    event_date: this.form.date,
                    event_title: this.form.title,
                    event_theme: this.form.theme
                });

                //XXX should save in db

                // clear the form data
                this.form.title = '';
                this.form.date = '';
                this.form.theme = 'blue';

                // close the modal
                this.form.isOpen = false;
            },

            toggleModalBox(id) {
                // toggle the modal box or init
                this.modalStateById[id] = id in this.modalStateById
                    ? !this.modalStateById[id]
                    : true;
            }
        }
    }
</script>

<script src="https://player.vimeo.com/api/player.js"></script>

@endsection
