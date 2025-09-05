<x-layouts.dashboard title="System Settings">
    <div class="px-4 py-6 space-y-6">
        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white bg-gradient-to-r from-gray-600 to-neutral-600 bg-clip-text text-transparent">
                    System Settings
                </h1>
                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                    Configure application settings and permissions
                </p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-flex items-center px-3 py-2 bg-neutral-600 hover:bg-neutral-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Settings Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Role Overview -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-neutral-900 dark:text-white">System Roles</h2>
                    <a href="{{ route('roles.create') }}" 
                       class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add Role
                    </a>
                </div>
                <div class="space-y-3">
                    @foreach($roles as $role)
                        <div class="flex items-center justify-between p-3 bg-neutral-50 dark:bg-neutral-700/50 rounded-lg">
                            <div>
                                <p class="font-medium text-neutral-900 dark:text-white">{{ ucfirst($role->name) }}</p>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $role->users_count }} users</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('roles.show', $role) }}" 
                                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('roles.edit', $role) }}" 
                                   class="text-amber-600 hover:text-amber-800 dark:text-amber-400 dark:hover:text-amber-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Permissions Overview -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">System Permissions</h2>
                <div class="space-y-4">
                    @foreach($permissions as $category => $perms)
                        <div>
                            <h3 class="text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">{{ ucfirst($category) }}</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($perms as $permission)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                                        {{ $permission->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- System Actions -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
            <h2 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">System Maintenance</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                
                <!-- Cache Management -->
                <div class="p-4 border border-dashed border-yellow-300 rounded-lg hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-colors duration-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <h3 class="font-medium text-neutral-900 dark:text-white">Cache Management</h3>
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3">Clear application cache to ensure latest changes are reflected</p>
                    <form method="POST" action="{{ route('admin.cache.clear') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                            Clear Cache
                        </button>
                    </form>
                </div>

                <!-- User Management -->
                <div class="p-4 border border-dashed border-blue-300 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors duration-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        <h3 class="font-medium text-neutral-900 dark:text-white">User Management</h3>
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3">Manage system users and their access levels</p>
                    <a href="{{ route('users.index') }}" 
                       class="inline-flex items-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                        Manage Users
                    </a>
                </div>

                <!-- Role Management -->
                <div class="p-4 border border-dashed border-green-300 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors duration-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <h3 class="font-medium text-neutral-900 dark:text-white">Role & Permissions</h3>
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3">Configure roles and permissions for fine-grained access control</p>
                    <a href="{{ route('roles.index') }}" 
                       class="inline-flex items-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                        Manage Roles
                    </a>
                </div>

                <!-- Analytics -->
                <div class="p-4 border border-dashed border-purple-300 rounded-lg hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors duration-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <h3 class="font-medium text-neutral-900 dark:text-white">System Analytics</h3>
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3">View comprehensive reports and system insights</p>
                    <a href="{{ route('admin.analytics') }}" 
                       class="inline-flex items-center px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                        View Analytics
                    </a>
                </div>

                <!-- Data Management -->
                <div class="p-4 border border-dashed border-red-300 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors duration-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                        </svg>
                        <h3 class="font-medium text-neutral-900 dark:text-white">Data Management</h3>
                    </div>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400 mb-3">Manage events, venues, organizers, and attendees</p>
                    <a href="{{ route('events.index') }}" 
                       class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md transition-colors duration-200">
                        Manage Data
                    </a>
                </div>

                <!-- System Info -->
                <div class="p-4 border border-dashed border-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-900/20 transition-colors duration-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="font-medium text-neutral-900 dark:text-white">System Information</h3>
                    </div>
                    <div class="text-sm text-neutral-600 dark:text-neutral-400 space-y-1">
                        <p>Laravel Version: {{ app()->version() }}</p>
                        <p>PHP Version: {{ PHP_VERSION }}</p>
                        <p>Environment: {{ app()->environment() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
