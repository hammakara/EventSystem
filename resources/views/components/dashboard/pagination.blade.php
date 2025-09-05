<div class="inline-flex items-center gap-2">
    <button class="px-3 py-2 rounded-xl border border-violet-100 bg-white text-sm dark:bg-neutral-900 dark:border-neutral-800">Prev</button>
    <div class="hidden sm:flex items-center gap-1">
        @for ($i = 1; $i <= 5; $i++)
            <button class="w-9 h-9 rounded-xl text-sm {{ $i===1 ? 'bg-fuchsia-600 text-white shadow-sm' : 'bg-white border border-violet-100 text-neutral-700 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-300' }}">{{ $i }}</button>
        @endfor
    </div>
    <button class="px-3 py-2 rounded-xl border border-violet-100 bg-white text-sm dark:bg-neutral-900 dark:border-neutral-800">Next</button>
</div>
