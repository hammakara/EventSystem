@props(['tabs' => [], 'active' => 'active'])
<div class="flex items-center gap-2">
    @foreach ($tabs as $tab)
        @php($is = $active === $tab['key'])
        <button x-on:click="$dispatch('tab-change', '{{ $tab['key'] }}')" class="px-3 py-1.5 rounded-full text-sm font-medium border transition {{ $is ? 'bg-fuchsia-600 text-white border-fuchsia-600' : 'bg-white border-violet-100 text-neutral-700 hover:bg-violet-50 dark:bg-neutral-900 dark:border-neutral-800 dark:text-neutral-300' }}">
            {{ $tab['label'] }} <span class="opacity-60">({{ $tab['count'] }})</span>
        </button>
    @endforeach
</div>
