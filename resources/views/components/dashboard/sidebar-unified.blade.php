@props(['items' => [], 'adminItems' => [], 'user' => null])

<aside class="hidden md:flex transition-all duration-300 ease-in-out will-change-[width]" role="navigation"
    aria-label="Sidebar" x-bind:class="sidebarCollapsed ? 'md:w-16 lg:w-20' : 'md:w-64 lg:w-72 xl:w-80'"
    x-bind:style="{ minWidth: sidebarCollapsed ? '4rem' : '16rem' }"
    x-data="sidebarData()">
    
    <div class="flex flex-col h-screen sticky top-0 bg-white/95 backdrop-blur-xl border-r border-gray-200/50 dark:bg-gray-900/95 dark:border-gray-700/50 shadow-2xl">
        
        <!-- Enhanced Header -->
        <div class="flex items-center h-16 px-4 gap-3 border-b border-gray-200/50 dark:border-gray-700/50">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-purple-500 via-pink-500 to-indigo-500 flex items-center justify-center text-white font-bold text-lg shadow-lg transform hover:scale-110 transition-all duration-300 animate-pulse-slow">
                V
            </div>
            <div x-show="!sidebarCollapsed" x-cloak class="flex-1 min-w-0" 
                 x-transition:enter="transition ease-out duration-300 delay-100"
                 x-transition:enter-start="opacity-0 translate-x-3"
                 x-transition:enter-end="opacity-100 translate-x-0">
                <span class="font-bold text-lg bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    Ventixe
                </span>
                @if($user)
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                        {{ $user->name }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Enhanced Navigation -->
        <nav class="flex-1 overflow-y-auto p-3 space-y-1 text-sm custom-scrollbar">
            
            <!-- Main Navigation -->
            <div class="space-y-2">
                <div class="flex items-center justify-between px-3 py-2">
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                        x-show="!sidebarCollapsed" x-cloak>
                        Main
                    </p>
                    <div x-show="sidebarCollapsed" class="w-full h-px bg-gray-300 dark:bg-gray-600"></div>
                </div>
                
                <ul class="space-y-1">
                    <!-- Dashboard -->
                    <li class="relative">
                        <a href="{{ route('dashboard.events') ?? route('dashboard') }}" 
                           aria-label="Dashboard"
                           class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                  {{ request()->routeIs(['dashboard*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}"
                           x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                           
                            @if(request()->routeIs(['dashboard*']))
                                <span aria-hidden="true"
                                    class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-purple-500 to-pink-500 shadow-sm animate-pulse"></span>
                            @endif
                            
                            <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                 x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            
                            <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                Dashboard
                            </span>
                            
                            <!-- Tooltip when collapsed -->
                            <div x-show="sidebarCollapsed" x-cloak
                                class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                    Dashboard
                                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>

                    <!-- Events -->
                    <li class="relative">
                        <a href="{{ route('events.index') }}" 
                           aria-label="Events"
                           class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                  {{ request()->routeIs(['events*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}"
                           x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                           
                            @if(request()->routeIs(['events*']))
                                <span aria-hidden="true"
                                    class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-purple-500 to-pink-500 shadow-sm animate-pulse"></span>
                            @endif
                            
                            <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                 x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            
                            <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                Events
                            </span>
                            
                            <!-- Tooltip when collapsed -->
                            <div x-show="sidebarCollapsed" x-cloak
                                class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                    Events
                                    <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>

                    @if(auth()->user()?->hasAnyRole(['admin', 'organizer']))
                        <!-- Organizers -->
                        <li class="relative">
                            <a href="{{ route('organizers.index') }}" 
                               aria-label="Organizers"
                               class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                      {{ request()->routeIs(['organizers*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}"
                               x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                               
                                @if(request()->routeIs(['organizers*']))
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-purple-500 to-pink-500 shadow-sm animate-pulse"></span>
                                @endif
                                
                                <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                     x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                    Organizers
                                </span>
                                
                                <!-- Tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                        Organizers
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- Venues -->
                        <li class="relative">
                            <a href="{{ route('venues.index') }}" 
                               aria-label="Venues"
                               class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                      {{ request()->routeIs(['venues*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}"
                               x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                               
                                @if(request()->routeIs(['venues*']))
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-purple-500 to-pink-500 shadow-sm animate-pulse"></span>
                                @endif
                                
                                <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                     x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                    Venues
                                </span>
                                
                                <!-- Tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                        Venues
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- Attendees -->
                        <li class="relative">
                            <a href="{{ route('attendees.index') }}" 
                               aria-label="Attendees"
                               class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                      {{ request()->routeIs(['attendees*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}"
                               x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                               
                                @if(request()->routeIs(['attendees*']))
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-purple-500 to-pink-500 shadow-sm animate-pulse"></span>
                                @endif
                                
                                <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                     x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m3 5.197V9a3 3 0 00-3-3H9m1.5-2-3 3 3 3"/>
                                </svg>
                                
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                    Attendees
                                </span>
                                
                                <!-- Tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                        Attendees
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- Vendors -->
                        <li class="relative">
                            <a href="{{ route('vendors.index') }}" 
                               aria-label="Vendors"
                               class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-purple-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                      {{ request()->routeIs(['vendors*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}"
                               x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                               
                                @if(request()->routeIs(['vendors*']))
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-purple-500 to-pink-500 shadow-sm animate-pulse"></span>
                                @endif
                                
                                <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                     x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m0 0v.5A2.5 2.5 0 0113.5 9h-3A2.5 2.5 0 018 6.5V6"/>
                                </svg>
                                
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                    Vendors
                                </span>
                                
                                <!-- Tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                        Vendors
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            
            <!-- Admin Navigation -->
            @if(auth()->user()?->hasRole('admin'))
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
                        <!-- Admin Dashboard -->
                        <li class="relative">
                            <a href="{{ route('admin.dashboard') }}" 
                               aria-label="Admin Dashboard"
                               class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                      {{ request()->routeIs(['admin.dashboard']) ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}"
                               x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                               
                                @if(request()->routeIs(['admin.dashboard']))
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-red-500 to-orange-500 shadow-sm animate-pulse"></span>
                                @endif
                                
                                <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                     x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                    Admin Dashboard
                                </span>
                                
                                <!-- Tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                        Admin Dashboard
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- User Management -->
                        <li class="relative">
                            <a href="{{ route('users.index') }}" 
                               aria-label="User Management"
                               class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                      {{ request()->routeIs(['users*']) ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}"
                               x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                               
                                @if(request()->routeIs(['users*']))
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-red-500 to-orange-500 shadow-sm animate-pulse"></span>
                                @endif
                                
                                <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                     x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                    User Management
                                </span>
                                
                                <!-- Tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                        User Management
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- Role Management -->
                        <li class="relative">
                            <a href="{{ route('roles.index') }}" 
                               aria-label="Role Management"
                               class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                      {{ request()->routeIs(['roles*', 'permissions*']) ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}"
                               x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                               
                                @if(request()->routeIs(['roles*', 'permissions*']))
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-red-500 to-orange-500 shadow-sm animate-pulse"></span>
                                @endif
                                
                                <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                     x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                    Role Management
                                </span>
                                
                                <!-- Tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                        Role Management
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- Analytics -->
                        <li class="relative">
                            <a href="{{ route('admin.analytics') }}" 
                               aria-label="Analytics"
                               class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                      {{ request()->routeIs(['admin.analytics']) ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}"
                               x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                               
                                @if(request()->routeIs(['admin.analytics']))
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-red-500 to-orange-500 shadow-sm animate-pulse"></span>
                                @endif
                                
                                <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                     x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                    Analytics
                                </span>
                                
                                <!-- Tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                        Analytics
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- System Settings -->
                        <li class="relative">
                            <a href="{{ route('admin.settings') }}" 
                               aria-label="System Settings"
                               class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                      {{ request()->routeIs(['admin.settings']) ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}"
                               x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'">
                               
                                @if(request()->routeIs(['admin.settings']))
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-red-500 to-orange-500 shadow-sm animate-pulse"></span>
                                @endif
                                
                                <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                     x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' : 'group-hover:scale-110'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                                </svg>
                                
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium">
                                    System Settings
                                </span>
                                
                                <!-- Tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                        System Settings
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </nav>

        <!-- Enhanced Footer with Logout -->
        <div class="mt-auto p-3 border-t border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-purple-50/50 dark:from-gray-800/50 dark:to-gray-700/50">
            <div class="space-y-2">
                <!-- Logout Button (Always Visible) -->
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 hover:shadow-lg hover:scale-[1.02] transform
                                   bg-gradient-to-r from-red-500/10 to-orange-500/10 border border-red-200/30 dark:border-red-700/30 text-red-700 dark:text-red-300 hover:from-red-500/20 hover:to-orange-500/20 group"
                            x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'"
                            title="Sign out">
                        
                        <svg class="w-5 h-5 flex-shrink-0 transition-all duration-300 group-hover:scale-110" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        
                        <span x-show="!sidebarCollapsed" x-cloak class="font-semibold">
                            Sign Out
                        </span>
                        
                        <!-- Tooltip when collapsed -->
                        <div x-show="sidebarCollapsed" x-cloak
                            class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                            <div class="whitespace-nowrap rounded-xl bg-gray-900/95 dark:bg-gray-800/95 text-white text-sm px-4 py-2 shadow-2xl backdrop-blur-sm border border-gray-700/50">
                                Sign Out
                                <div class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-gray-900/95 dark:bg-gray-800/95 rotate-45 border-l border-t border-gray-700/50">
                                </div>
                            </div>
                        </div>
                    </button>
                </form>
                
                <!-- Collapse/expand button -->
                <button class="w-full inline-flex items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm text-gray-700 dark:text-gray-300 px-3 py-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 group shadow-sm"
                    x-on:click="toggleCollapse()" 
                    :title="sidebarCollapsed ? 'Expand sidebar (Ctrl+B)' : 'Collapse sidebar (Ctrl+B)'">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!sidebarCollapsed" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16M10 6l-6 6 6 6" />
                        <path x-show="sidebarCollapsed" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m10 6l6-6-6-6" />
                    </svg>
                    <span x-show="!sidebarCollapsed" x-cloak class="ml-2 text-sm font-medium">Collapse</span>
                </button>
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
    background: linear-gradient(45deg, rgb(147 51 234), rgb(219 39 119));
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, rgb(126 34 206), rgb(190 24 93));
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
        init() {
            // Any additional initialization
        }
    }
}
</script>
