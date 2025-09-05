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
    <div class="flex items-center h-16 px-4 gap-3 border-b border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-purple-50/50 to-pink-50/50 dark:from-gray-800/50 dark:to-gray-700/50">
        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-purple-500 via-pink-500 to-indigo-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">
            V
        </div>
        <div class="flex-1 min-w-0">
            <span class="font-bold text-lg bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                Ventixe
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
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard.events') ?? route('dashboard') }}" 
                       class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['dashboard*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}">
                        
                        <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>

                <!-- Events -->
                <li>
                    <a href="{{ route('events.index') }}" 
                       class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['events*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}">
                        
                        <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        
                        <span class="font-medium">Events</span>
                    </a>
                </li>

                @if(auth()->user()?->hasAnyRole(['admin', 'organizer']))
                    <!-- Organizers -->
                    <li>
                        <a href="{{ route('organizers.index') }}" 
                           class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['organizers*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}">
                            
                            <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            
                            <span class="font-medium">Organizers</span>
                        </a>
                    </li>

                    <!-- Venues -->
                    <li>
                        <a href="{{ route('venues.index') }}" 
                           class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['venues*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}">
                            
                            <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            
                            <span class="font-medium">Venues</span>
                        </a>
                    </li>

                    <!-- Attendees -->
                    <li>
                        <a href="{{ route('attendees.index') }}" 
                           class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['attendees*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}">
                            
                            <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m3 5.197V9a3 3 0 00-3-3H9m1.5-2-3 3 3 3"/>
                            </svg>
                            
                            <span class="font-medium">Attendees</span>
                        </a>
                    </li>

                    <!-- Vendors -->
                    <li>
                        <a href="{{ route('vendors.index') }}" 
                           class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['vendors*']) ? 'bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold shadow-md backdrop-blur-sm border border-purple-200/30 dark:border-purple-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-purple-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-purple-600 dark:hover:text-purple-400' }}">
                            
                            <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m0 0v.5A2.5 2.5 0 0113.5 9h-3A2.5 2.5 0 018 6.5V6"/>
                            </svg>
                            
                            <span class="font-medium">Vendors</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        
        <!-- Admin Navigation -->
        @if(auth()->user()?->hasRole('admin'))
            <div class="pt-4 border-t border-red-200/50 dark:border-red-800/50 mt-6 space-y-2">
                <h3 class="px-3 py-2 text-xs font-bold text-red-600 dark:text-red-400 uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    Administration
                </h3>
                
                <ul class="space-y-1">
                    <!-- Admin Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['admin.dashboard']) ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}">
                            
                            <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            
                            <span class="font-medium">Admin Dashboard</span>
                        </a>
                    </li>

                    <!-- User Management -->
                    <li>
                        <a href="{{ route('users.index') }}" 
                           class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['users*']) ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}">
                            
                            <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            
                            <span class="font-medium">User Management</span>
                        </a>
                    </li>

                    <!-- Role Management -->
                    <li>
                        <a href="{{ route('roles.index') }}" 
                           class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['roles*', 'permissions*']) ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}">
                            
                            <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            
                            <span class="font-medium">Role Management</span>
                        </a>
                    </li>

                    <!-- Analytics -->
                    <li>
                        <a href="{{ route('admin.analytics') }}" 
                           class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['admin.analytics']) ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}">
                            
                            <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            
                            <span class="font-medium">Analytics</span>
                        </a>
                    </li>

                    <!-- System Settings -->
                    <li>
                        <a href="{{ route('admin.settings') }}" 
                           class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-300 {{ request()->routeIs(['admin.settings']) ? 'bg-gradient-to-r from-red-500/20 via-orange-500/20 to-yellow-500/20 text-red-700 dark:text-red-300 font-semibold shadow-md backdrop-blur-sm border border-red-200/30 dark:border-red-700/30' : 'hover:bg-gradient-to-r hover:from-white/80 hover:to-red-50/80 dark:hover:from-gray-800/80 dark:hover:to-gray-700/80 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400' }}">
                            
                            <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-110" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                            </svg>
                            
                            <span class="font-medium">System Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif
    </nav>

    <!-- Enhanced Footer with Prominent Logout -->
    <div class="p-4 border-t border-gray-200/50 dark:border-gray-700/50 bg-gradient-to-r from-gray-50/50 to-purple-50/50 dark:from-gray-800/50 dark:to-gray-700/50">
        <div class="space-y-3">
            <!-- User info -->
            @if($user)
                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-sm">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                    </div>
                </div>
            @endif
            
            <!-- Logout Button (Prominent) -->
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center justify-center gap-3 px-4 py-4 rounded-2xl bg-gradient-to-r from-red-500/10 to-orange-500/10 border-2 border-red-200/30 dark:border-red-700/30 text-red-700 dark:text-red-300 hover:from-red-500/20 hover:to-orange-500/20 hover:border-red-300/50 transition-all duration-300 group shadow-lg">
                    <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span class="font-bold text-lg">Sign Out</span>
                </button>
            </form>
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
</style>
