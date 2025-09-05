@props(['items' => [], 'adminItems' => [], 'user' => null])

<aside class="md:hidden fixed inset-y-0 left-0 w-80 max-w-sm z-50 transform bg-white/98 backdrop-blur-xl border-r border-gray-200/50 dark:bg-gray-900/98 dark:border-gray-700/50 shadow-2xl"
       x-show="sidebarMobileOpen" 
       x-transition:enter="transition ease-out duration-300" 
       x-transition:enter-start="-translate-x-full" 
       x-transition:enter-end="translate-x-0" 
       x-transition:leave="transition ease-in duration-250" 
       x-transition:leave-start="translate-x-0" 
       x-transition:leave-end="-translate-x-full"
       x-trap.noscroll="sidebarMobileOpen"
       x-data="{ activeSubmenu: null }">
    
    <!-- Enhanced Header -->
    <div class="flex items-center h-16 px-4 gap-3 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-indigo-50/50 to-purple-50/50 dark:from-gray-800/50 dark:to-gray-700/50">
        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">
            {{ strtoupper(substr(config('app.name', 'EM'), 0, 1)) }}
        </div>
        <div class="flex-1 min-w-0">
            <span class="font-bold text-lg bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                {{ config('app.name', 'Event Manager') }}
            </span>
            @if($user)
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                    Welcome, {{ $user->name }}
                </p>
            @endif
        </div>
        <button class="p-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 shadow-sm" 
                x-on:click="sidebarMobileOpen=false"
                aria-label="Close sidebar">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Quick Stats for Mobile -->
    @if($user)
        <div class="px-4 py-3 border-b border-gray-200/30 dark:border-gray-700/30 bg-gradient-to-r from-indigo-50/30 to-purple-50/30 dark:from-gray-800/30 dark:to-gray-700/30">
            <div class="grid grid-cols-2 gap-3 text-center">
                <div class="p-3 rounded-xl bg-white/80 dark:bg-gray-800/80 shadow-sm backdrop-blur-sm">
                    <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">{{ $quickStats['events'] ?? 0 }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Events</div>
                </div>
                <div class="p-3 rounded-xl bg-white/80 dark:bg-gray-800/80 shadow-sm backdrop-blur-sm">
                    <div class="text-xl font-bold text-purple-600 dark:text-purple-400">{{ $quickStats['attendees'] ?? 0 }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Attendees</div>
                </div>
            </div>
        </div>
    @endif

    <!-- Enhanced Navigation -->
    <nav class="p-4 space-y-1 text-sm overflow-y-auto flex-1 custom-scrollbar">
        
        <!-- Main Navigation -->
        <div class="space-y-2">
            <h3 class="px-3 py-2 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                </svg>
                Main Menu
            </h3>
            
            <ul class="space-y-1">
                @foreach ($items as $item)
                    <li>
                        <!-- Main menu item -->
                        <a href="{{ isset($item['submenu']) ? '#' : $item['href'] }}" 
                           @if(isset($item['submenu'])) @click.prevent="activeSubmenu = activeSubmenu === '{{ $item['label'] }}' ? null : '{{ $item['label'] }}'" @endif
                           class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ $item['active'] ? 'bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-pink-500/20 text-indigo-700 dark:text-indigo-300 font-semibold shadow-md backdrop-blur-sm border border-indigo-200/30 dark:border-indigo-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-indigo-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                            
                            <!-- Icon with badge -->
                            <div class="relative">
                                <x-dashboard.icon :name="$item['icon']" class="w-5 h-5 transition-all duration-300 group-hover:scale-110" />
                                @if(isset($item['badge']))
                                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-bounce">
                                        {{ $item['badge'] }}
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Label -->
                            <span class="font-medium flex-1">{{ $item['label'] }}</span>
                            
                            <!-- Submenu indicator -->
                            @if(isset($item['submenu']))
                                <svg class="w-4 h-4 transition-transform duration-300" 
                                     :class="activeSubmenu === '{{ $item['label'] }}' ? 'rotate-180' : ''"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            @endif
                        </a>
                        
                        <!-- Submenu -->
                        @if(isset($item['submenu']))
                            <div x-show="activeSubmenu === '{{ $item['label'] }}'" 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 class="mt-2 ml-8 space-y-1 border-l-2 border-indigo-200/50 dark:border-indigo-700/50 pl-4">
                                @foreach($item['submenu'] as $subItem)
                                    <a href="{{ $subItem['href'] }}"
                                       class="block px-3 py-2 text-sm rounded-lg transition-all duration-200 {{ $subItem['active'] ?? false ? 'bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                                        {{ $subItem['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        
        <!-- Admin Navigation -->
        @if(count($adminItems) > 0)
            <div class="pt-4 border-t border-red-200/50 dark:border-red-800/50 mt-6 space-y-2">
                <h3 class="px-3 py-2 text-xs font-bold text-red-600 dark:text-red-400 uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    Administration
                </h3>
                
                <ul class="space-y-1">
                    @foreach ($adminItems as $item)
                        <li>
                            <a href="{{ $item['href'] }}" 
                               class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ $item['active'] ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}">
                                
                                <div class="relative">
                                    <x-dashboard.icon :name="$item['icon']" class="w-5 h-5 transition-all duration-300 group-hover:scale-110" />
                                    @if(isset($item['badge']))
                                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-orange-500 text-white text-xs rounded-full flex items-center justify-center animate-bounce">
                                            {{ $item['badge'] }}
                                        </span>
                                    @endif
                                </div>
                                
                                <span class="font-medium">{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="pt-4 border-t border-gray-200/50 dark:border-gray-700/50 mt-6 space-y-2">
            <h3 class="px-3 py-2 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Quick Actions
            </h3>
            
            <div class="space-y-2">
                @if(auth()->user()?->hasAnyRole(['admin', 'organizer']))
                    <button onclick="window.location='{{ route('events.create') }}'" 
                            class="w-full flex items-center gap-3 px-3 py-3 rounded-2xl bg-gradient-to-r from-green-500/10 to-emerald-500/10 border border-green-200/30 dark:border-green-700/30 text-green-700 dark:text-green-300 hover:from-green-500/20 hover:to-emerald-500/20 transition-all duration-300 group">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <span class="font-medium">Create Event</span>
                    </button>
                @endif
                
                <button onclick="window.location='{{ route('dashboard.events') }}'" 
                        class="w-full flex items-center gap-3 px-3 py-3 rounded-2xl bg-gradient-to-r from-blue-500/10 to-indigo-500/10 border border-blue-200/30 dark:border-blue-700/30 text-blue-700 dark:text-blue-300 hover:from-blue-500/20 hover:to-indigo-500/20 transition-all duration-300 group">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Enhanced Footer -->
    <div class="p-4 border-t border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-indigo-50/50 dark:from-gray-800/50 dark:to-gray-700/50">
        <div class="space-y-3">
            <!-- User info -->
            @if($user)
                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                    </div>
                </div>
            @endif
            
            <!-- Action buttons -->
            <div class="grid grid-cols-2 gap-3">
                <button onclick="toggleDarkMode()" 
                        class="flex items-center justify-center gap-2 px-3 py-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 shadow-sm"
                        title="Toggle theme">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <span class="text-xs font-medium">Theme</span>
                </button>
                
                <form method="POST" action="{{ route('logout') }}" class="contents">
                    @csrf
                    <button type="submit" 
                            class="flex items-center justify-center gap-2 px-3 py-2 rounded-xl border border-red-200 dark:border-red-700 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all duration-300 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="text-xs font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>

<style>
.custom-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: rgb(156 163 175) transparent;
}

.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, rgb(99 102 241), rgb(168 85 247));
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, rgb(79 70 229), rgb(147 51 234));
}
</style>

<script>
function toggleDarkMode() {
    const isDark = document.documentElement.classList.contains('dark');
    if (isDark) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('darkMode', 'false');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('darkMode', 'true');
    }
}
</script>
