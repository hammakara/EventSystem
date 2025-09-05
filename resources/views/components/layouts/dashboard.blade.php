<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard' }} •Ventixe</title>

    <!-- Build assets via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for interactivity + plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|instrument-sans:400,500,600,700" rel="stylesheet" />
</head>
<body x-data="{
        sidebarCollapsed: JSON.parse(localStorage.getItem('sidebarCollapsed') ?? 'false'),
        sidebarMobileOpen: false,
        theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
        toggleCollapse(){ this.sidebarCollapsed = !this.sidebarCollapsed; localStorage.setItem('sidebarCollapsed', JSON.stringify(this.sidebarCollapsed)); },
        toggleTheme(){ this.theme = this.theme === 'dark' ? 'light' : 'dark'; },
    }" x-init="localStorage.setItem('theme', theme); if(theme==='dark'){document.documentElement.classList.add('dark')}else{document.documentElement.classList.remove('dark')}; $watch('theme', v=>{localStorage.setItem('theme', v); if(v==='dark'){document.documentElement.classList.add('dark')}else{document.documentElement.classList.remove('dark')}})" class="h-full bg-gradient-to-br from-[#f6f3ff] via-[#f9f7ff] to-[#f3f6ff] dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-900 text-neutral-900 dark:text-neutral-100">

<style>[x-cloak]{display:none !important}</style>

<!-- Mobile hamburger (global) -->
<button
    x-cloak
    x-show="!sidebarMobileOpen"
    type="button"
    class="md:hidden fixed top-3 left-3 z-50 inline-flex items-center justify-center rounded-xl border border-violet-100 dark:border-neutral-800 bg-white/90 dark:bg-neutral-900/90 backdrop-blur p-2 shadow-sm"
    x-on:click="sidebarMobileOpen = true"
    aria-label="Open menu"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
</button>

<!-- Mobile overlay -->
<div x-show="sidebarMobileOpen" x-transition.opacity class="fixed inset-0 bg-black/40 z-40 md:hidden" x-on:click="sidebarMobileOpen=false"></div>

@php($navItems = [
    ['icon' => 'home', 'label' => 'Dashboard', 'href' => route('dashboard.events'), 'active' => request()->routeIs('dashboard.events')],
    ['icon' => 'sparkles', 'label' => 'Events', 'href' => route('events.index'), 'active' => request()->routeIs('events.*')],
    ['icon' => 'users', 'label' => 'Attendees', 'href' => route('attendees.index'), 'active' => request()->routeIs('attendees.*')],
    ['icon' => 'building', 'label' => 'Venues', 'href' => route('venues.index'), 'active' => request()->routeIs('venues.*')],
    ['icon' => 'briefcase', 'label' => 'Vendors', 'href' => route('vendors.index'), 'active' => request()->routeIs('vendors.*')],
    ['icon' => 'user-group', 'label' => 'Organizers', 'href' => route('organizers.index'), 'active' => request()->routeIs('organizers.*')],
])

@php($adminNavItems = auth()->user() && auth()->user()->hasRole('admin') ? [
    ['icon' => 'users', 'label' => 'User Management', 'href' => route('users.index'), 'active' => request()->routeIs('users.*')],
    ['icon' => 'shield-check', 'label' => 'Role Management', 'href' => route('roles.index'), 'active' => request()->routeIs('roles.*')],
] : [])

<div class="min-h-screen">
    <div class="flex">
        <!-- Sidebar (desktop) -->
        <x-dashboard.sidebar :items="$navItems" :adminItems="$adminNavItems" />

        <!-- Sidebar (mobile drawer) -->
        <x-dashboard.sidebar-mobile :items="$navItems" :adminItems="$adminNavItems" />

        <!-- Main content -->
        <div class="flex-1 min-w-0">
            <div class="px-4 pt-4">
                <x-ui.flash />
            </div>
            {{ $slot }}
        </div>
    </div>
</div>

</body>
</html>

