
<div class="flex flex-col w-full my-3 p-2 lg:w-1/3 lg:ml-2 lg:my-6">
    <?php /* Box #1 - Subscribe to newsletter */ ?>
    @include("theme::components.card", [
        "type" => "text",
        "position" => "left",
        "title" => "Subscribe to our Newsletter",
        "subtitle" => "Don't miss out on updates anymore!",
        "content" => [
            "Make sure you don't miss any of our updates anymore by subscribing for our newsletter. You will receive weekly e-mails about SaaS products."
        ],
        "icon" => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>',
        "link" => "https://resoftware.es/subscribe",
        "cta_text" => "Subscribe now",
        "cta_external" => true,
        "extra_css" => "mb-6"
    ])

    <?php /* Box #1 - Subscribe to newsletter */ ?>
    @include("theme::components.card", [
        "type" => "text",
        "position" => "left",
        "title" => "Join the learning evolution",
        "subtitle" => "Level up your learning journey now!",
        "content" => [
            "Level up your learning journey! Upgrade your plan today and gain access to our exclusive online courses and expert instructors."
        ],
        "icon" => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg>',
        "link" => route('wave.settings', 'plans'),
        "cta_text" => "Upgrade my plan",
        "extra_css" => "mb-6"
    ])
</div>

