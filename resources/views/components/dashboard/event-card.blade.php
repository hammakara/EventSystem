@props(['event'])
<div x-data="{visible:false}" x-intersect.once="visible=true" :class="visible ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-3'" class="group relative rounded-2xl border border-violet-100/70 bg-white/80 backdrop-blur hover:-translate-y-0.5 hover:shadow-xl transition duration-500 ease-out overflow-hidden dark:bg-neutral-900/70 dark:border-neutral-800">
    <div class="absolute inset-0 pointer-events-none opacity-0 group-hover:opacity-100 transition bg-gradient-to-br from-fuchsia-500/10 via-transparent to-indigo-500/10"></div>
    <div class="relative">
        <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="h-44 w-full object-cover">
        <div class="absolute top-2 left-2 flex gap-2">
            <span class="text-[11px] px-2 py-1 rounded-full bg-white/90 border border-violet-100 dark:bg-neutral-900/70 dark:border-neutral-700">{{ $event['category'] }}</span>
            <span class="text-[11px] px-2 py-1 rounded-full bg-fuchsia-600 text-white shadow">{{ $event['status'] }}</span>
        </div>
        <button class="absolute top-2 right-2 p-1.5 rounded-full bg-white/90 text-fuchsia-600 hover:bg-white shadow" x-on:click.stop="$dispatch('open-event', @js($event))" title="Quick view">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12zm9.75-3a3 3 0 100 6 3 3 0 000-6z"/></svg>
        </button>
    </div>
    <div class="p-4 space-y-2">
        <p class="text-xs text-neutral-500">{{ $event['date'] }}</p>
        <h3 class="font-semibold leading-snug">{{ $event['title'] }}</h3>
        <p class="text-xs text-neutral-500">@ {{ $event['location'] }}</p>
        <x-dashboard.progress :value="$event['progress']" />
        <div class="flex items-center justify-between pt-1">
            <span class="text-sm text-neutral-500">{{ $event['progress'] }}%</span>
            <span class="font-semibold text-fuchsia-600">${{ $event['price'] }}</span>
        </div>
    </div>
</div>
