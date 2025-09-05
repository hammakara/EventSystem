<div class="inline-flex rounded-xl border border-violet-100 overflow-hidden dark:border-neutral-800">
    <button x-bind:class="view==='grid' ? 'bg-fuchsia-600 text-white' : 'bg-white text-neutral-700 dark:bg-neutral-900 dark:text-neutral-300'" x-on:click="view='grid'" class="px-3 py-2">Grid</button>
    <button x-bind:class="view==='list' ? 'bg-fuchsia-600 text-white' : 'bg-white text-neutral-700 dark:bg-neutral-900 dark:text-neutral-300'" x-on:click="view='list'" class="px-3 py-2">List</button>
</div>
