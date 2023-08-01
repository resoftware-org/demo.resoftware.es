@php
    $xShow = isset($xShow) ? $xShow : "dummy";
@endphp

<!-- Modal box for courses details -->
<div
    id="course-details-modal-{{$course->id}}"
    style=" background-color: rgba(0, 0, 0, 0.9)"
    class="fixed z-40 top-0 right-0 left-0 bottom-0 h-auto w-full"
    x-show.transition.opacity="{{$xShow}}"
>
    <div class="relative w-full max-h-full">
        <div class="p-4 mx-auto absolute left-0 right-0 mt-1 lg:mt-12">
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
                    <p class="hidden lg:block text-justify">{{$course->description}}</p>

                    <div class="flex flex-col items-center justify-center my-1 lg:flex-row lg:my-6">
                        <div class="w-1/3 lg:w-1/6">
                            <img class="w-24 h-24 rounded-md" src="/storage/{{$course->image}}" alt="{{$course->title}}" />
                        </div>
                        <div class="w-3/4 mt-6 lg:w-2/6 lg:mt-0">
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

                    <p class="hidden lg:block text-justify">
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
</div> <!-- End Modal Box for courses details -->
