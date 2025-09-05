<x-layouts.dashboard title="Admin Dashboard">
    <div class="px-4 py-6 space-y-6">
        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white bg-gradient-to-r from-red-600 to-purple-600 bg-clip-text text-transparent">
                    Admin Dashboard
                </h1>
                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                    System overview and management controls
                </p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-2">
                <form method="POST" action="{{ route('admin.cache.clear') }}" class="inline">
                    @csrf
                    <button type="submit" 
                            class="inline-flex items-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Clear Cache
                    </button>
                </form>
                <a href="{{ route('admin.analytics') }}" 
                   class="inline-flex items-center px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    View Analytics
                </a>
            </div>
        </div>

        <!-- Overview Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Users</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ number_format($stats['total_users']) }}</p>
                    </div>
                </div>
                <div class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">
                    <span class="text-green-600 dark:text-green-400">Admin: {{ $stats['admin_users'] }}</span> • 
                    <span class="text-blue-600 dark:text-blue-400">Organizers: {{ $stats['organizer_users'] }}</span> • 
                    <span class="text-purple-600 dark:text-purple-400">Attendees: {{ $stats['attendee_users'] }}</span>
                </div>
            </div>

            <!-- Total Events -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total Events</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ number_format($stats['total_events']) }}</p>
                    </div>
                </div>
                <div class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">
                    <span class="text-green-600 dark:text-green-400">Active: {{ $stats['active_events'] }}</span> • 
                    <span class="text-neutral-600 dark:text-neutral-400">Past: {{ $stats['past_events'] }}</span>
                </div>
            </div>

            <!-- System Resources -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Venues</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ number_format($stats['total_venues']) }}</p>
                    </div>
                </div>
                <div class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">
                    <span>Organizers: {{ $stats['total_organizers'] }}</span> • 
                    <span>Vendors: {{ $stats['total_vendors'] }}</span>
                </div>
            </div>

            <!-- System Config -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">System</p>
                        <p class="text-2xl font-bold text-neutral-900 dark:text-white">{{ number_format($stats['total_roles']) }}</p>
                    </div>
                </div>
                <div class="mt-4 text-sm text-neutral-500 dark:text-neutral-400">
                    <span>Roles: {{ $stats['total_roles'] }}</span> • 
                    <span>Permissions: {{ $stats['total_permissions'] }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Access Links -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
            <h2 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Quick Access</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($quickAccessLinks as $link)
                    <a href="{{ $link['href'] }}" 
                       class="block p-4 rounded-lg border-2 border-dashed border-{{ $link['color'] }}-200 hover:border-{{ $link['color'] }}-400 hover:bg-{{ $link['color'] }}-50 dark:hover:bg-{{ $link['color'] }}-900/20 transition-all duration-200 group">
                        <div class="flex items-center mb-2">
                            <svg class="w-6 h-6 text-{{ $link['color'] }}-600 dark:text-{{ $link['color'] }}-400 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($link['icon'] === 'plus-circle')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @elseif($link['icon'] === 'map-pin')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                @elseif($link['icon'] === 'users')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                @elseif($link['icon'] === 'user-circle')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @elseif($link['icon'] === 'shield-check')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                @elseif($link['icon'] === 'chart-bar')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                @elseif($link['icon'] === 'cog-6-tooth')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                @endif
                            </svg>
                        </div>
                        <h3 class="font-medium text-neutral-900 dark:text-white text-sm">{{ $link['title'] }}</h3>
                        <p class="text-xs text-neutral-600 dark:text-neutral-400 mt-1">{{ $link['description'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Users -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">Recent Users</h2>
                    <a href="{{ route('users.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all</a>
                </div>
                <div class="space-y-3">
                    @forelse($stats['recent_users'] as $user)
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8">
                                <div class="h-8 w-8 rounded-full bg-violet-100 dark:bg-violet-900 flex items-center justify-center">
                                    <span class="text-xs font-medium text-violet-700 dark:text-violet-300">
                                        {{ substr($user->name, 0, 2) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-3 flex-1 min-w-0">
                                <p class="text-sm font-medium text-neutral-900 dark:text-white truncate">{{ $user->name }}</p>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $user->email }}</p>
                            </div>
                            <div class="text-xs text-neutral-500 dark:text-neutral-400">
                                {{ $user->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">No recent users</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Events -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">Recent Events</h2>
                    <a href="{{ route('events.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all</a>
                </div>
                <div class="space-y-3">
                    @forelse($stats['recent_events'] as $event)
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="h-8 w-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-3 flex-1 min-w-0">
                                <p class="text-sm font-medium text-neutral-900 dark:text-white truncate">{{ $event->title }}</p>
                                <p class="text-xs text-neutral-500 dark:text-neutral-400">
                                    by {{ $event->organizer->name ?? 'Unknown' }}
                                </p>
                            </div>
                            <div class="text-xs text-neutral-500 dark:text-neutral-400">
                                {{ $event->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">No recent events</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
