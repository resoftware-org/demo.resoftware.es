<nav class="flex items-center justify-end flex-1 hidden w-full h-full space-x-10 md:flex">

    <!-- Product features mega menu -->
    <div @mouseenter="dropdown = true" @mouseleave="dropdown=false" @click.away="dropdown=false" x-data="{ dropdown: false }" class="relative h-full select-none">
        <div :class="{ 'text-wave-600': dropdown, 'text-gray-500': !dropdown }" class="inline-flex items-center h-full space-x-2 text-base font-medium leading-6 text-gray-500 transition duration-150 ease-in-out cursor-pointer select-none group hover:text-wave-600 focus:outline-none focus:text-wave-600">
            <span>{{ __('replay.app.menu.product') }}</span>

            <!-- icon caret down -->
            <svg class="w-5 h-5 text-gray-400 transition duration-150 ease-in-out group-hover:text-wave-600 group-focus:text-wave-600" x-bind:class="{ 'text-wave-600': dropdown, 'text-gray-400': !dropdown }" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </div>

        <div x-show="dropdown"
            x-transition:enter="duration-200 ease-out scale-95"
            x-transition:enter-start="opacity-50 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition duration-100 ease-in scale-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed w-full transform -translate-x-1/2 xl:w-screen xl:max-w-6xl xl:px-2 xl:absolute sm:px-0 lg:ml-0 left-1/2" x-cloak>

            <div class="overflow-hidden shadow-lg xl:rounded-xl">
                <div class="flex items-stretch justify-center overflow-hidden bg-white shadow-xs xl:rounded-xl">

                    <div class="flex flex-col">
                        <div class="flex h-full">
                            <div class="relative flex flex-col items-start justify-start hidden w-full h-full max-w-xs bg-center bg-cover lg:block" style="background-image:url('https://cdn.devdojo.com/images/october2020/wave-menu-bg.jpeg')">
                                <div class="relative flex flex-col items-start justify-center w-full h-full px-16 py-8">

                                    <img src="{{ Voyager::image(theme('dark_logo')) }}" class="z-20 w-auto h-20">
                                    <h3 class="z-30 mt-1 mt-3 text-lg font-thin text-wave-200">{{__('replay.guest.slogan_text')}}</h3>

                                    <span class="relative z-20 inline-flex mt-5 rounded-md shadow-sm">
                                        <a href="https://resoftware.es/get-a-free-quote/" target="_blank" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white border border-transparent rounded-md text-wave-500 hover:bg-gray-100 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray active:bg-gray-100">
                                            Get a free quote
                                            <span class="absolute top-0 right-0 px-3 py-1 -mt-4 -mr-8 text-xs text-white rounded-full bg-wave-400">NEW</span>
                                        </a>
                                    </span>
                                </div>
                                <div class="absolute inset-0 w-full h-full opacity-75 bg-wave-600"></div>
                                <div class="absolute inset-0 w-full h-full opacity-75 bg-gradient-to-br from-wave-600 to-indigo-600"></div>
                            </div>
                            <div class="relative z-20 grid gap-6 px-5 pt-6 pb-8 bg-white border-t border-b border-transparent xl:border-gray-200 sm:gap-8 sm:p-8">

                                @php $features = config("features", []); @endphp
                                @for ($i = 0, $m = 4; $i < $m; $i++)
                                <a href="#" class="flex items-start inline-block p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg group">
                                    <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mt-1 mr-3 transition duration-300 ease-in-out transform scale-100 bg-indigo-100 rounded-full text-wave-600 group-hover:text-white group-hover:bg-wave-600 group-hover:scale-110 group-hover:rotate-3 -rotate-3">
                                        <img src="{{$features[$i]->image}}" alt="{{ __($features[$i]->title) }}" class="relative flex-shrink-0 w-6 h-6" />
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-base font-medium leading-6 text-gray-900">
                                            {{ __($features[$i]->title) }}
                                        </p>
                                        <p class="text-sm leading-5 text-gray-500">
                                            {{ __($features[$i]->description) }}
                                        </p>
                                    </div>
                                </a>
                                @endfor

                            </div>

                            <div class="relative z-20 grid gap-6 px-5 pt-6 pb-8 bg-white border-t border-b border-r border-transparent rounded-r-xl xl:border-gray-200 sm:gap-8 sm:p-8">

                            @for ($i = 4, $m = 8; $i < $m; $i++)
                                <a href="#" class="flex items-start inline-block p-3 -m-3 space-x-4 transition duration-150 ease-in-out rounded-lg group">
                                    <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mt-1 mr-3 transition duration-300 ease-in-out transform scale-100 bg-indigo-100 rounded-full text-wave-600 group-hover:text-white group-hover:bg-wave-600 group-hover:scale-110 group-hover:rotate-3 -rotate-3">
                                        <img src="{{$features[$i]->image}}" alt="{{ __($features[$i]->title) }}" class="relative flex-shrink-0 w-6 h-6" />
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-base font-medium leading-6 text-gray-900">
                                            {{ __($features[$i]->title) }}
                                        </p>
                                        <p class="text-sm leading-5 text-gray-500">
                                            {{ __($features[$i]->description) }}
                                        </p>
                                    </div>
                                </a>
                            @endfor

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic app guest menu -->
    @include("theme::partials.menu", [
        "menu" => $menu,
        "classes" => "text-base font-medium leading-6 text-gray-500 transition duration-150 ease-in-out hover:text-wave-600 focus:outline-none focus:text-wave-600",
        "withIcons" => false,
    ])

    <div class="w-1 h-5 mx-10 border-r border-gray-300"></div>

    @if (auth()->guest())
        <a href="{{ route('login') }}" class="text-base font-medium leading-6 text-gray-500 whitespace-no-wrap hover:text-wave-600 focus:outline-none focus:text-gray-900">
            Sign in
        </a>
        <span class="inline-flex rounded-md shadow-sm">
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-white whitespace-no-wrap transition duration-150 ease-in-out border border-transparent rounded-md bg-wave-500 hover:bg-wave-600 focus:outline-none focus:border-indigo-700 focus:shadow-outline-wave active:bg-wave-700">
                Sign up
            </a>
        </span>
    @elseif (auth()->user() !== null)
        @include("theme::partials.profile-dropdown")
    @endif
</nav>
