
<x-layouts.app>
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
            <div>
                {{-- Content can be pulled from a settings table or a CMS --}}
                <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">Start your journey with <span class="text-blue-600">Our Events</span></h1>
                <p class="mt-3 text-lg text-gray-800 dark:text-neutral-400">Discover amazing events, connect with professionals, and grow your network.</p>

                <div class="mt-7 grid gap-3 w-full sm:inline-flex">
                    {{-- Primary CTA with improved hover, focus, and font-weight --}}
                    <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 transition duration-300 ease-in-out focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50" href="{{ route('allEvents') }}">
                        Get started
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                    {{-- Secondary CTA: Added focus ring for accessibility --}}
                    <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800" href="#">
                        Contact sales team
                    </a>
                </div>
                {{-- Social Proof Section --}}
                <div class="mt-6 lg:mt-10 grid grid-cols-2 gap-x-5">
                    {{-- This section can also be made dynamic by fetching reviews from a database --}}
                    <div class="py-5">
                        <div class="flex gap-x-1">
                            {{-- Using the new star component --}}
                            <x-icons.star />
                            <x-icons.star />
                            <x-icons.star />
                            <x-icons.star />
                            <x-icons.star />
                        </div>
                        <p class="mt-3 text-sm text-gray-800 dark:text-neutral-200"><span class="font-bold">4.6</span> /5 - from 12k reviews</p>
                        <div class="mt-5">
                            <img class="h-auto w-16" src="/path/to/google-logo.svg" alt="Google Reviews Logo">
                        </div>
                    </div>
                    <div class="py-5">
                        <div class="flex gap-x-1">
                            <x-icons.star />
                            <x-icons.star />
                            <x-icons.star />
                            <x-icons.star />
                            <x-icons.star />
                        </div>
                        <p class="mt-3 text-sm text-gray-800 dark:text-neutral-200"><span class="font-bold">4.8</span> /5 - from 5k reviews</p>
                        <div class="mt-5">
                            <img class="h-auto w-16" src="/path/to/another-logo.svg" alt="Capterra Reviews Logo">
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative ms-4">
                <img class="w-full rounded-md" src="https://images.unsplash.com/photo-1665686377065-08ba896d16fd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=700&h=800&q=80" alt="Professionals collaborating at an event">
                <div class="absolute inset-0 -z-1 bg-linear-to-tr from-gray-200 via-white/0 to-white/0 size-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-neutral-800 dark:via-neutral-900/0 dark:to-neutral-900/0"></div>

                <div class="absolute bottom-0 start-0">
                    <svg class="w-2/3 ms-auto h-auto text-white dark:text-neutral-900" width="630" height="451" viewBox="0 0 630 451" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="531" y="352" width="99" height="99" fill="currentColor"/><rect x="140" y="352" width="106" height="99" fill="currentColor"/><rect x="482" y="402" width="64" height="49" fill="currentColor"/><rect x="433" y="402" width="63" height="49" fill="currentColor"/><rect x="384" y="352" width="49" height="50" fill="currentColor"/><rect x="531" y="328" width="50" height="50" fill="currentColor"/><rect x="99" y="303" width="49" height="58" fill="currentColor"/><rect x="99" y="352" width="49" height="50" fill="currentColor"/><rect x="99" y="392" width="49" height="59" fill="currentColor"/><rect x="44" y="402" width="66" height="49" fill="currentColor"/><rect x="234" y="402" width="62" height="49" fill="currentColor"/><rect x="334" y="303" width="50" height="49" fill="currentColor"/><rect x="581" width="49" height="49" fill="currentColor"/><rect x="581" width="49" height="64" fill="currentColor"/><rect x="482" y="123" width="49" height="49" fill="currentColor"/><rect x="507" y="124" width="49" height="24" fill="currentColor"/><rect x="531" y="49" width="99" height="99" fill="currentColor"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    ---

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="max-w-2xl text-center mx-auto mb-10 lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Upcoming Events</h2>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">We've hosted events for some of the world's leading companies.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10 lg:mb-14">

            {{-- Loop through the dynamic event data from the controller --}}
            @forelse($latestEvents as $event)
                <x-event-card :event="$event" />
            @empty
                <p class="col-span-full text-center text-gray-600 dark:text-neutral-400">No upcoming events right now. Please check back later!</p>
            @endforelse

        </div>
        <div class="text-center">
            <div class="inline-block bg-white border border-gray-200 shadow-2xs rounded-full dark:bg-neutral-900 dark:border-neutral-800">
                <div class="py-3 px-4 flex items-center gap-x-2">
                    <p class="text-gray-600 dark:text-neutral-400">
                        Want to see more?
                    </p>
                    <a class="inline-flex items-center gap-x-1.5 text-blue-600 decoration-2 hover:underline focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50 font-medium dark:text-blue-500" href="{{ route('allEvents') }}">
                        See all events
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
