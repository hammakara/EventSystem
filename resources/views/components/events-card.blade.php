@props(['event'])

<a class="group grid sm:grid-cols-12 gap-x-5 items-center p-3 bg-white border border-gray-200 rounded-xl shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all dark:bg-neutral-900 dark:border-neutral-800 dark:hover:bg-neutral-800/50" href="#">
    <div class="sm:col-span-4 md:col-span-3 rounded-xl overflow-hidden">
        <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out size-full object-cover" src="{{ $event->image_url ?? 'https://placehold.co/320x224/3b82f6/ffffff?text=Event' }}" alt="{{ $event->title }}">
    </div>

    <div class="sm:col-span-8 md:col-span-9 grow p-2">
        <p class="mb-2 inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full dark:bg-blue-900 dark:text-blue-300">
            {{ $event->category->name ?? 'General' }}
        </p>

        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
            {{ $event->title }}
        </h3>

        <div class="mt-2 flex flex-wrap items-center gap-x-5 gap-y-1 text-sm text-gray-600 dark:text-neutral-400">
            <div class="flex items-center gap-x-1.5">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                <span>{{ \Carbon\Carbon::parse($event->start_date)->format('D, M j, Y') }}</span>
            </div>
            <div class="flex items-center gap-x-1.5">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 7.3 11.7Z"/></svg>
                <span>{{ $event->location }}</span>
            </div>
        </div>

        <p class="mt-3 text-gray-600 dark:text-neutral-400">
            {{ Str::limit($event->description, 100) }}
        </p>

        <div class="mt-4">
            <p class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 group-hover:underline font-medium dark:text-blue-500">
                View Event
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </p>
        </div>
    </div>
</a>
