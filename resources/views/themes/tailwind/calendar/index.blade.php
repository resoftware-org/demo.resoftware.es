@extends('theme::layouts.app')

@section('title', 'Calendar')

@section('content')

<div
    class="w-full flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5"
    x-data="reapp_calendar()"
    x-init="[initializeDate()]"
    x-cloak
>
    <!-- source: https://tailwindcomponents.com/component/calendar-ui-with-tailwindcss-and-alpinejs -->
    <div class="antialiased sans-serif bg-gray-100 w-full lg:w-4/6">
        <h2>Calendar</h2>
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
                        <div class="flex flex-wrap" style="margin-bottom: -40px;">
                            <template x-for="(day, index) in DAYS" :key="index">	
                                <div style="width: 14.26%" class="px-2 py-2 w-[14.26%]">
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
                                    class="text-center border-r border-b px-4 pt-2 h-[40px] lg:h-[80px] 2xl:h-[120px]"
                                ></div>
                            </template>
                            <template x-for="(date, dateIndex) in days_of_month" :key="dateIndex">	
                                <div style="width: 14.28%;" class="px-2 pt-2 border-r border-b relative h-[40px] lg:px-4 lg:h-[80px] 2xl:h-[120px]">
                                    <div
                                        @click="showEventModal(date)"
                                        x-text="date"
                                        class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                                        :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"	
                                    ></div>
                                    <div class="overflow-y-auto mt-1 h-[40px] lg:h-[80px] 2xl:h-[120px]">
                                        <template x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )">	
                                            <div
                                                class="px-2 py-1 rounded-lg mt-1 overflow-hidden border"
                                                :class="{
                                                    'border-blue-200 text-blue-800 bg-blue-100': event.event_theme === 'blue',
                                                    'border-red-200 text-red-800 bg-red-100': event.event_theme === 'red',
                                                    'border-yellow-200 text-yellow-800 bg-yellow-100': event.event_theme === 'yellow',
                                                    'border-green-200 text-green-800 bg-green-100': event.event_theme === 'green',
                                                    'border-purple-200 text-purple-800 bg-purple-100': event.event_theme === 'purple'
                                                }"
                                            >
                                                <p x-text="event.event_title" class="text-sm truncate leading-tight"></p>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    <!-- End Calendar Days -->
                </div>
            </div> <!-- End Calendar UI -->

            <div style=" background-color: rgba(0, 0, 0, 0.8)" class="fixed z-40 top-0 right-0 left-0 bottom-0 h-full w-full" x-show.transition.opacity="form.isOpen">
                <div class="p-4 max-w-xl mx-auto relative absolute left-0 right-0 overflow-hidden mt-24">
                    <div class="shadow absolute right-0 top-0 w-10 h-10 rounded-full bg-white text-gray-500 hover:text-gray-800 inline-flex items-center justify-center cursor-pointer"
                        x-on:click="form.isOpen = !form.isOpen">
                        <svg class="fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M16.192 6.344L11.949 10.586 7.707 6.344 6.293 7.758 10.535 12 6.293 16.242 7.707 17.656 11.949 13.414 16.192 17.656 17.606 16.242 13.364 12 17.606 7.758z" />
                        </svg>
                    </div>

                    <div class="shadow w-full rounded-lg bg-white overflow-hidden w-full block p-8">

                        <h2 class="font-bold text-2xl mb-6 text-gray-800 border-b pb-2">Add Event Details</h2>

                        <div class="mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Event title</label>
                            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="form.title">
                        </div>

                        <div class="mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Event date</label>
                            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" x-model="form.date" readonly>
                        </div>

                        <div class="inline-block w-64 mb-4">
                            <label class="text-gray-800 block mb-1 font-bold text-sm tracking-wide">Select a theme</label>
                            <div class="relative">
                                <select @change="form.theme = $event.target.value;" x-model="form.theme" class="block appearance-none w-full bg-gray-200 border-2 border-gray-200 hover:border-gray-500 px-4 py-2 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 text-gray-700">
                                        <template x-for="(theme, index) in themes">
                                            <option :value="theme.value" x-text="theme.label"></option>
                                        </template>
                                    
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
    
                        <div class="mt-8 text-right">
                            <button type="button" class="bg-white hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 border border-gray-300 rounded-lg shadow-sm mr-2" @click="form.isOpen = !form.isOpen">
                                Cancel
                            </button>
                            <button type="button" class="bg-gray-800 hover:bg-gray-700 text-white font-semibold py-2 px-4 border border-gray-700 rounded-lg shadow-sm" @click="addEvent()">
                                Save Event
                            </button>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-6 text-gray-500 w-full lg:w-2/6">
        <h2>Today</h2>
        <p class="py-6">No events configured for today!</p>
    </div>
</div>

<script>
    const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    function reapp_calendar() {
        return {
            month: '',
            year: '',
            days_of_month: [],
            days_blank: [],

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
                    event_theme: "blue" // course
                },
                @endforeach

            ],

            initializeDate() {
                let today = new Date();
                this.month = today.getMonth();
                this.year = today.getFullYear();
                this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();

                // also initialize days boxes
                this.initializeBoxes();
            },

            initializeBoxes() {
                // count of days in current month
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                // find out day of week for 1st of month
                let dayOfWeek = new Date(this.year, this.month).getDay();

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
            }
        }
    }
</script>

@endsection
