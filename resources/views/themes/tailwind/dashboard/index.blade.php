@extends('theme::layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="relative flex flex-col mx-auto max-w-7xl xl:px-5">
    <?php /* Row #1 - 2 Cards */ ?>
    <div class="relative flex flex-col px-8 mx-auto my-0 lg:my-3 lg:flex-row">

        <?php /* Box #1 - Welcome to re:Play */ ?>
        @include("theme::components.card", [
            "type" => "text",
            "position" => "left",
            "title" => "Welcome to re:Play",
            "subtitle" => "Smart online courses",
            "content" => [
                "Manage all your courses from one place and securely, then connect any of your devices to stream, share or just watch your content.",
                "Finally an easy way to share your online courses with colleagues."
            ],
            "icon" => '<svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
            "link" => url('docs'),
            "cta_text" => "Read the docs"
        ])

        <?php /* Box #2 - Sharing is caring */ ?>
        @include("theme::components.card", [
            "type" => "text",
            "position" => "right",
            "title" => "Your online courses, anywhere!",
            "subtitle" => "Don't compromise security for comfort!",
            "content" => [
                "Finally an easy way to share your online courses with colleagues, without compromising your privacy or the security of your files.",
                "Share your online courses to your devices or using temporary links."
            ],
            "icon" => '<svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg>',
            "link" => url('support'),
            "cta_text" => "Watch The Videos"
        ])
    </div>

    <?php /* Row #2 - 2 Cards */ ?>
    <div class="relative flex flex-col px-8 mx-auto my-0 lg:my-3 lg:flex-row">

        <?php /* Box #3 - Data Vault */ ?>
        @include("theme::components.card", [
            "type" => "text",
            "position" => "left",
            "title" => "Encrypted data vaults",
            "subtitle" => "Secure communication for your courses",
            "content" => [
                "Use encrypted data vaults to store and group files, folders and archives. You can upload files to your re:Play Cloud from anywhere.",
                "This software works with: Windows, Linux, MacOS, Android, iOS."
            ],

            "icon" => '<svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>',
            "link" => url('docs'),
            "cta_text" => "Read the docs"
        ])

        <?php /* Box #4 - No install */ ?>
        @include("theme::components.card", [
            "type" => "text",
            "position" => "right",
            "title" => "No installation needed",
            "subtitle" => "Use any browser to access your online courses",
            "content" => [
                "Using next-generation Web technologies, we provide a secure in-Browser experience such that re:Play is available from anywhere, using any device.",
                "Use your Laptop, Tablet, Smartphone, Smart TV, anything works!"
            ],
            "icon" => '<svg class="w-6 h-6 text-wave-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z" /></svg>',
            "link" => url('support'),
            "cta_text" => "Watch The Videos"
        ])

    </div>
</div>

@endsection
