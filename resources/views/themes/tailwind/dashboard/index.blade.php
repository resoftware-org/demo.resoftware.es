@extends('theme::layouts.app')


@section('content')

    <?php /* Row #1 - 2 Cards */ ?>
    <div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">

        <?php /* Box #1 - Welcome to re:Media */ ?>
        <div class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border rounded-lg lg:mr-3 lg:mb-0 border-gray-150">
            <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
                <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                    <svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="relative flex-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-700">
                        Welcome to re:Media
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Smart media management solution
                    </p>
                </div>
            </div>
            <div class="relative p-5">
                <p class="text-base leading-loose text-gray-500">
                Manage all your media from one place and securely, then connect
                any of your devices to stream, share or just watch your content.<br /><br />
                Finally an easy way to share your media files with family and friends.
                </p>
                <span class="inline-flex mt-5 rounded-md shadow-sm">
                    <a href="{{ url('docs') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50">
                        Read The Docs
                    </a>
                </span>
            </div>
        </div>

        <?php /* Box #2 - Sharing is caring */ ?>
        <div class="flex flex-col justify-start flex-1 overflow-hidden bg-white border rounded-lg lg:ml-3 border-gray-150">
            <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
                <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                    <svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg>
                </div>
                <div class="relative flex-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-700">
                        Your media files, anywhere!
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Don't compromise security for comfort!
                    </p>
                </div>
            </div>
            <div class="relative p-5">
                <p class="text-base leading-loose text-gray-500">
                Finally an easy way to share your media files with family and friends,
                without compromising your privacy or the security of your files.<br /><br />
                Share your media files to your devices or using temporary links.
                </p>
                <span class="inline-flex mt-5 rounded-md shadow-sm">
                    <a href="https://devdojo.com/course/wave" target="_blank" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50">
                        Watch The Videos
                    </a>
                </span>
            </div>
        </div>
    </div>

    <?php /* Row #2 - 2 Cards */ ?>
    <div class="flex flex-col px-8 mx-auto my-6 lg:flex-row max-w-7xl xl:px-5">

        <?php /* Box #3 - Data Vault */ ?>
        <div class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border rounded-lg lg:mr-3 lg:mb-0 border-gray-150">
            <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
                <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                    <svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="relative flex-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-700">
                        Encrypted data vaults
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Secure communication for your media files
                    </p>
                </div>
            </div>
            <div class="relative p-5">
                <p class="text-base leading-loose text-gray-500">
                Use encrypted data vaults to store and group files, folders and
                archives. You can upload files to your re:Media Cloud from anywhere. <br /><br />
                This software is available for: Windows, Linux, MacOS, Android, iOS.
                </p>
                <span class="inline-flex mt-5 rounded-md shadow-sm">
                    <a href="{{ url('docs') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50">
                        Read The Docs
                    </a>
                </span>
            </div>
        </div>

        <?php /* Box #4 - Data Vault */ ?>
        <div class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border rounded-lg lg:mr-3 lg:mb-0 border-gray-150">
            <div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
                <div class="flex items-center justify-center w-12 h-12 mr-5 rounded-lg bg-wave-100">
                    <svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="relative flex-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-700">
                        No installation needed
                    </h3>
                    <p class="text-sm leading-5 text-gray-500 mt">
                        Use any browser to access your media files
                    </p>
                </div>
            </div>
            <div class="relative p-5">
                <p class="text-base leading-loose text-gray-500">
                Using next-generation Web technologies, we provide a secure
                in-Browser experience such that re:Media is available from anywhere. <br /><br />
                Use your Laptop, Tablet, Smartphone, Smart TV, anything works!
                </p>
                <span class="inline-flex mt-5 rounded-md shadow-sm">
                    <a href="{{ url('docs') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50">
                        Read The Docs
                    </a>
                </span>
            </div>
        </div>

    </div>

@endsection
