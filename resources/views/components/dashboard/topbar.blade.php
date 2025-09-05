<div class="flex items-center justify-between px-4 lg:px-6 py-4">
    <div class="flex items-center gap-3">
        <!-- Mobile: open drawer -->
        <button class="md:hidden inline-flex items-center justify-center rounded-xl border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 p-2" x-on:click="sidebarMobileOpen = true">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <!-- Desktop: collapse/expand -->
        <button class="hidden md:inline-flex items-center justify-center rounded-xl border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 p-2" x-on:click="toggleCollapse()" :title="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M10 6l-6 6 6 6"/></svg>
        </button>
        <div>
            <h1 class="text-2xl font-semibold">Events</h1>
            <p class="text-sm text-neutral-500">Dashboard / Events</p>
        </div>
    </div>
    <div class="flex items-center gap-3">
        <!-- Theme toggle -->
        <button class="relative p-2 rounded-xl bg-white border border-violet-100 hover:shadow-sm dark:bg-neutral-900 dark:border-neutral-800" x-on:click="toggleTheme()" :title="theme==='dark' ? 'Switch to light' : 'Switch to dark'">
            <template x-if="theme==='dark'"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M21.752 15.002A9.718 9.718 0 0112 21.75 9.75 9.75 0 1112 3a9.718 9.718 0 019.752 6.748A7.5 7.5 0 0021.752 15.002z"/></svg></template>
            <template x-if="theme!=='dark'"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3.75a.75.75 0 01.75.75V6a.75.75 0 01-1.5 0V4.5a.75.75 0 01.75-.75zm0 12a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5zM18 12a.75.75 0 01.75-.75H21a.75.75 0 010 1.5h-2.25A.75.75 0 0118 12zM3 12a.75.75 0 01.75-.75H6a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm12.97-6.22a.75.75 0 011.06 0l1.06 1.06a.75.75 0 01-1.06 1.06l-1.06-1.06a.75.75 0 010-1.06zM5.91 16.03a.75.75 0 011.06 0l1.06 1.06a.75.75 0 11-1.06 1.06L5.91 17.09a.75.75 0 010-1.06zm11.12 1.06l1.06 1.06a.75.75 0 101.06-1.06l-1.06-1.06a.75.75 0 10-1.06 1.06zM6.97 5.78L5.91 4.72A.75.75 0 014.85 3.66a.75.75 0 011.06 0l1.06 1.06a.75.75 0 11-1.06 1.06z"/></svg></template>
        </button>
        <button class="relative p-2 rounded-xl bg-white border border-violet-100 hover:shadow-sm dark:bg-neutral-900 dark:border-neutral-800">
            <x-dashboard.icon name="sparkles" class="w-5 h-5 text-brand" />
        </button>
        <div class="w-8 h-8 rounded-full bg-gradient-to-r from-fuchsia-500 to-indigo-500"></div>
        <div class="hidden sm:block">
            <p class="text-sm font-medium">Orlando Laurentius</p>
            <p class="text-xs text-neutral-500">Admin</p>
        </div>
    </div>
</div>
