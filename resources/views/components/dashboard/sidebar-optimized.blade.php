@props(['items' => [], 'adminItems' => [], 'user' => null])

<aside class="hidden md:flex transition-all duration-300 ease-in-out will-change-[width]" role="navigation"
    aria-label="Sidebar" x-bind:class="sidebarCollapsed ? 'md:w-16 lg:w-20' : 'md:w-64 lg:w-72 xl:w-80'"
    x-bind:style="{ minWidth: sidebarCollapsed ? '4rem' : '16rem' }"
    x-data="sidebarData()">
    
    <div class="flex flex-col h-screen sticky top-0 bg-white/95 backdrop-blur-xl border-r border-gray-200/50 dark:bg-gray-900/95 dark:border-gray-700/50 shadow-2xl">
        
        <!-- Enhanced Header with User Profile -->
        <div class="flex items-center h-16 px-4 gap-3 border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center text-white font-bold text-lg shadow-lg transform hover:scale-110 transition-all duration-300 animate-pulse-slow">
                {{ strtoupper(substr(config('app.name', 'EM'), 0, 1)) }}
            </div>
            <div x-show="!sidebarCollapsed" x-cloak class="flex-1 min-w-0" 
                 x-transition:enter="transition ease-out duration-300 delay-100"
                 x-transition:enter-start="opacity-0 translate-x-3"
                 x-transition:enter-end="opacity-100 translate-x-0">
                <span class="font-bold text-lg bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    {{ config('app.name', 'Event Manager') }}
                </span>
                @if($user)
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                        {{ $user->name }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Quick Stats (when expanded) -->
        <div x-show="!sidebarCollapsed" x-cloak class="px-4 py-3 border-b border-gray-200/30 dark:border-gray-700/30 bg-gradient-to-r from-indigo-50/50 to-purple-50/50 dark:from-gray-800/50 dark:to-gray-700/50"
             x-transition:enter="transition ease-out duration-300 delay-150"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100">
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div class="text-center p-2 rounded-lg bg-white/80 dark:bg-gray-800/80 shadow-sm">
                    <div class="font-bold text-indigo-600 dark:text-indigo-400">{{ $quickStats['events'] ?? 0 }}</div>
                    <div class="text-gray-500 dark:text-gray-400">Events</div>
                </div>
                <div class="text-center p-2 rounded-lg bg-white/80 dark:bg-gray-800/80 shadow-sm">
                    <div class="font-bold text-purple-600 dark:text-purple-400">{{ $quickStats['attendees'] ?? 0 }}</div>
                    <div class="text-gray-500 dark:text-gray-400">Attendees</div>
                </div>
            </div>
        </div>

        <!-- Enhanced Navigation -->
        <nav class="flex-1 overflow-y-auto p-3 space-y-1 text-sm custom-scrollbar">
            
            <!-- Main Navigation -->
            <div class="space-y-2">
                <div class="flex items-center justify-between px-3 py-2">
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                        x-show="!sidebarCollapsed" x-cloak>
                        Main Menu
                    </p>
                    <div x-show="sidebarCollapsed" class="w-full h-px bg-gray-300 dark:bg-gray-600"></div>
                </div>
                
                <ul class="space-y-1">
                    @foreach ($items as $item)
                        <li class="relative" x-data="{ showSubmenu: false }">
                            <a href="{{ $item['href'] }}" 
                               aria-label="{{ $item['label'] }}"
                               @if(isset($item['submenu'])) @click.prevent="showSubmenu = !showSubmenu" @endif
                               class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                      {{ $item['active'] ? 'bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-pink-500/20 text-indigo-700 dark:text-indigo-300 font-semibold shadow-md backdrop-blur-sm border border-indigo-200/30 dark:border-indigo-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-indigo-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400' }}"
                               x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'"
                               @if ($item['active']) aria-current="page" @endif>
                               
                                <!-- Active indicator -->
                                @if ($item['active'])
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-indigo-500 to-purple-500 shadow-sm animate-pulse"></span>
                                @endif
                                
                                <!-- Icon with enhanced animations -->
                                <div class="relative">
                                    <x-dashboard.icon :name="$item['icon']"
                                        class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                        x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'" />
                                    
                                    @if(isset($item['badge']))
                                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-bounce">
                                            {{ $item['badge'] }}
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Label with enhanced transitions -->
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium flex-1"
                                    x-transition:enter="transition ease-out duration-300 delay-100"
                                    x-transition:enter-start="opacity-0 translate-x-3"
                                    x-transition:enter-end="opacity-100 translate-x-0"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0">
                                    {{ $item['label'] }}
                                </span>
                                
                                <!-- Submenu indicator -->
                                @if(isset($item['submenu']))
                                    <svg x-show="!sidebarCollapsed" x-cloak
                                         class="w-4 h-4 transition-transform duration-300"
                                         :class="showSubmenu ? 'rotate-180' : ''"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                @endif
                                
                                <!-- Enhanced tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                        {{ $item['label'] }}
                                        @if(isset($item['description']))
                                            <div class="text-xs text-gray-400 mt-1">{{ $item['description'] }}</div>
                                        @endif
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            
                            <!-- Submenu -->
                            @if(isset($item['submenu']))
                                <div x-show="showSubmenu && !sidebarCollapsed" x-cloak
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                                     x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                                     class="mt-2 ml-8 space-y-1 border-l-2 border-indigo-200/50 dark:border-indigo-700/50 pl-4">
                                    @foreach($item['submenu'] as $subItem)
                                        <a href="{{ $subItem['href'] }}"
                                           class="block px-3 py-2 text-sm rounded-lg transition-all duration-200 {{ $subItem['active'] ?? false ? 'bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
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
                <div class="space-y-2 pt-4 border-t border-red-200/50 dark:border-red-800/50 mt-6">
                    <div class="flex items-center justify-between px-3 py-2">
                        <p class="text-xs font-bold text-red-600 dark:text-red-400 uppercase tracking-wider flex items-center gap-2"
                            x-show="!sidebarCollapsed" x-cloak>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Administration
                        </p>
                        <div x-show="sidebarCollapsed" class="w-full h-px bg-red-300 dark:bg-red-600"></div>
                    </div>
                    
                    <ul class="space-y-1">
                        @foreach ($adminItems as $item)
                            <li class="relative">
                                <a href="{{ $item['href'] }}" 
                                   aria-label="{{ $item['label'] }}"
                                   class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                          {{ $item['active'] ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}"
                                   x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'"
                                   @if ($item['active']) aria-current="page" @endif>
                                   
                                    @if ($item['active'])
                                        <span aria-hidden="true"
                                            class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-red-500 to-orange-500 shadow-sm animate-pulse"></span>
                                    @endif
                                    
                                    <div class="relative">
                                        <x-dashboard.icon :name="$item['icon']"
                                            class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                            x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'" />
                                        
                                        @if(isset($item['badge']))
                                            <span class="absolute -top-1 -right-1 w-3 h-3 bg-orange-500 text-white text-xs rounded-full flex items-center justify-center animate-bounce">
                                                {{ $item['badge'] }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"
                                        x-transition:enter="transition ease-out duration-300 delay-100"
                                        x-transition:enter-start="opacity-0 translate-x-3"
                                        x-transition:enter-end="opacity-100 translate-x-0"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0">
                                        {{ $item['label'] }}
                                    </span>
                                    
                                    <!-- Enhanced tooltip when collapsed -->
                                    <div x-show="sidebarCollapsed" x-cloak
                                        class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                        <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                            {{ $item['label'] }}
                                            @if(isset($item['description']))
                                                <div class="text-xs text-gray-400 mt-1">{{ $item['description'] }}</div>
                                            @endif
                                            <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Quick Actions Section -->
            <div x-show="!sidebarCollapsed" x-cloak class="pt-4 border-t border-gray-200/50 dark:border-gray-700/50 mt-6">
                <p class="px-3 py-2 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Quick Actions
                </p>
                <div class="space-y-2">
                    @if(auth()->user()?->hasAnyRole(['admin', 'organizer']))
                        <button onclick="window.location='{{ route('events.create') }}'" 
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl bg-gradient-to-r from-green-500/10 to-emerald-500/10 border border-green-200/30 dark:border-green-700/30 text-green-700 dark:text-green-300 hover:from-green-500/20 hover:to-emerald-500/20 transition-all duration-300 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span class="font-medium">Create Event</span>
                        </button>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Enhanced Footer -->
        <div class="mt-auto p-3 border-t border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-indigo-50/50 dark:from-gray-800/50 dark:to-gray-700/50">
            <div class="flex items-center justify-between gap-2">
                <!-- Collapse/expand button -->
                <button class="flex-1 inline-flex items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-700 dark:text-gray-300 px-3 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 group shadow-sm"
                    x-on:click="toggleCollapse()" 
                    :title="sidebarCollapsed ? 'Expand sidebar (Ctrl+B)' : 'Collapse sidebar (Ctrl+B)'">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!sidebarCollapsed" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M10 6l-6 6 6 6" />
                        <path x-show="sidebarCollapsed" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m10 6l6-6-6-6" />
                    </svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="ml-2 text-sm font-medium">Collapse</span>
                </button>
                
                <!-- Theme toggle -->
                <div x-show="!sidebarCollapsed" x-cloak>
                    <button class="inline-flex items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-700 dark:text-gray-300 p-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 group shadow-sm"
                        x-on:click="toggleDarkMode()" 
                        title="Toggle dark mode">
                        <svg x-show="!darkMode" class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg x-show="darkMode" x-cloak class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                </div>
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

@keyframes pulse-slow {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

.animate-pulse-slow {
    animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>

<script>
function sidebarData() {
    return {
        darkMode: localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),
        
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        },
        
        init() {
            // Apply initial dark mode
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            }
            
            // Listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                if (!localStorage.getItem('darkMode')) {
                    this.darkMode = e.matches;
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            });
        }
    }
}
</script>
