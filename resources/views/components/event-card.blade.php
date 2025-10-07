@props(['event'])

<a href="{{ route('eventShow', $event) }}" class="group flex flex-col bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-lg focus:outline-none focus:shadow-lg transition-all duration-300 dark:bg-neutral-900 dark:border-neutral-800">
    <div class="relative aspect-w-16 aspect-h-9">
        <img class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" src="{{ $event->image_url ?? 'https://placehold.co/560x315/3b82f6/ffffff?text=Event' }}" alt="{{ $event->title }}">
    </div>

    <div class="p-4 md:p-5">
        <p class="mb-2 inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full dark:bg-blue-900 dark:text-blue-300">
            {{ $event->category->title }}
        </p>

        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
            {{ $event->title }}
        </h3>

        <div class="mt-3 space-y-2 text-sm text-gray-600 dark:text-neutral-400">
            <div class="flex items-center gap-x-2">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                <span>{{ \Carbon\Carbon::parse($event->start_date)->format('D, M j, Y') }}</span>
            </div>
            <div class="flex items-center gap-x-2">
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="10" r="3"/><path d="M12 21.7C17.3 17 20 13 20 10a8 8 0 1 0-16 0c0 3 2.7 7 7.3 11.7Z"/></svg>
                <span>{{ $event->location }}</span>
            </div>
        </div>
    </div>
</a>
