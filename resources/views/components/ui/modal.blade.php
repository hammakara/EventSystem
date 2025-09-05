@props(['title' => null])
<div {{ $attributes->merge(['class' => 'fixed inset-0 z-50 flex items-center justify-center']) }} aria-modal="true" role="dialog">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50" x-transition.opacity></div>

    <!-- Dialog -->
    <div class="relative mx-4 w-full max-w-3xl rounded-2xl bg-white dark:bg-neutral-900 border border-violet-100 dark:border-neutral-800 shadow-2xl overflow-hidden"
         x-transition:enter="transform transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-3 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transform transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-3 scale-95">
        @if($title)
            <div class="px-5 py-4 border-b border-violet-100 dark:border-neutral-800 flex items-center justify-between">
                <h3 class="text-lg font-semibold">{{ $title }}</h3>
                <button class="rounded-lg p-2 hover:bg-neutral-100 dark:hover:bg-neutral-800" x-on:click="$dispatch('close-modal')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6.75 6.75l10.5 10.5m0-10.5L6.75 17.25"/></svg>
                </button>
            </div>
        @endif
        <div class="p-5">
            {{ $slot }}
        </div>
    </div>
</div>

