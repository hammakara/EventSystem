<x-layouts.dashboard title="View Role">
    <div class="px-4 py-6 space-y-6">
        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-neutral-900 dark:text-white capitalize">{{ $role->name }} Role</h1>
                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                    Role details and assigned permissions
                </p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-2">
                @can('edit roles')
                <a href="{{ route('roles.edit', $role) }}" 
                   class="inline-flex items-center px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Role
                </a>
                @endcan
                <a href="{{ route('roles.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-neutral-200 hover:bg-neutral-300 dark:bg-neutral-600 dark:hover:bg-neutral-500 text-neutral-700 dark:text-neutral-200 text-sm font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Roles
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Role Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 h-16 w-16">
                            <div class="h-16 w-16 rounded-full {{ $role->name === 'admin' ? 'bg-red-100 dark:bg-red-900' : ($role->name === 'organizer' ? 'bg-blue-100 dark:bg-blue-900' : 'bg-green-100 dark:bg-green-900') }} flex items-center justify-center">
                                @if($role->name === 'admin')
                                    <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                @elseif($role->name === 'organizer')
                                    <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 104 0V4h-4z"/>
                                    </svg>
                                @else
                                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                @endif
                            </div>
                        </div>
                        <div class="ml-6">
                            <h2 class="text-2xl font-bold text-neutral-900 dark:text-white capitalize">{{ $role->name }}</h2>
                            <div class="flex items-center mt-1 space-x-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $role->name === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : 
                                       ($role->name === 'organizer' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 
                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300') }}">
                                    {{ ucfirst($role->name) }}
                                </span>
                                <span class="text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ $role->users->count() }} {{ Str::plural('user', $role->users->count()) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Role Details</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-xs text-neutral-500 dark:text-neutral-400">Role ID</dt>
                                    <dd class="text-sm text-neutral-900 dark:text-white font-mono">{{ $role->id }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-neutral-500 dark:text-neutral-400">Guard Name</dt>
                                    <dd class="text-sm text-neutral-900 dark:text-white">{{ $role->guard_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-neutral-500 dark:text-neutral-400">Created</dt>
                                    <dd class="text-sm text-neutral-900 dark:text-white">{{ $role->created_at->format('M d, Y g:i A') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Statistics</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-xs text-neutral-500 dark:text-neutral-400">Total Permissions</dt>
                                    <dd class="text-sm text-neutral-900 dark:text-white">{{ $role->permissions->count() }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-neutral-500 dark:text-neutral-400">Assigned Users</dt>
                                    <dd class="text-sm text-neutral-900 dark:text-white">{{ $role->users->count() }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-neutral-500 dark:text-neutral-400">Last Updated</dt>
                                    <dd class="text-sm text-neutral-900 dark:text-white">{{ $role->updated_at->format('M d, Y g:i A') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Permissions -->
                @if($role->permissions->isNotEmpty())
                <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Assigned Permissions</h3>
                    <div class="space-y-4">
                        @php
                            $groupedPermissions = $role->permissions->groupBy(function($permission) {
                                return explode(' ', $permission->name)[1] ?? 'general';
                            });
                        @endphp
                        
                        @foreach($groupedPermissions as $category => $permissions)
                            <div>
                                <h4 class="text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                                    {{ ucfirst($category) }} Permissions ({{ $permissions->count() }})
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                                    @foreach($permissions as $permission)
                                        <div class="flex items-center p-2 bg-neutral-50 dark:bg-neutral-700 rounded-lg">
                                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span class="text-sm text-neutral-900 dark:text-white">{{ $permission->name }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <div class="text-center py-8">
                        <svg class="mx-auto h-8 w-8 text-neutral-300 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-neutral-900 dark:text-white">No permissions assigned</h3>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">This role doesn't have any permissions yet.</p>
                        @can('edit roles')
                        <div class="mt-4">
                            <a href="{{ route('roles.edit', $role) }}" 
                               class="inline-flex items-center px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                Assign Permissions
                            </a>
                        </div>
                        @endcan
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Users with this Role -->
                <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Users with this Role</h3>
                    <div class="space-y-3">
                        @foreach($role->users->take(10) as $user)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 rounded-full bg-violet-100 dark:bg-violet-900 flex items-center justify-center">
                                            <span class="text-xs font-medium text-violet-700 dark:text-violet-300">
                                                {{ substr($user->name, 0, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-3 min-w-0 flex-1">
                                        <p class="text-sm font-medium text-neutral-900 dark:text-white truncate">{{ $user->name }}</p>
                                        <p class="text-xs text-neutral-500 dark:text-neutral-400 truncate">{{ $user->email }}</p>
                                    </div>
                                </div>
                                @can('view users')
                                <a href="{{ route('users.show', $user) }}" 
                                   class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                                @endcan
                            </div>
                        @endforeach
                        @if($role->users->isEmpty())
                            <div class="text-center py-4">
                                <svg class="mx-auto h-8 w-8 text-neutral-300 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">No users have this role</p>
                            </div>
                        @elseif($role->users->count() > 10)
                            <div class="text-center pt-3 border-t border-neutral-200 dark:border-neutral-700">
                                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                                    And {{ $role->users->count() - 10 }} more users...
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Quick Actions</h3>
                    <div class="space-y-2">
                        @can('edit roles')
                        <a href="{{ route('roles.edit', $role) }}" 
                           class="block w-full px-4 py-2 text-left text-sm text-neutral-700 dark:text-neutral-200 hover:bg-neutral-100 dark:hover:bg-neutral-700 rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Role Details
                        </a>
                        @endcan

                        @can('manage permissions')
                        <a href="{{ route('roles.edit', $role) }}#permissions" 
                           class="block w-full px-4 py-2 text-left text-sm text-neutral-700 dark:text-neutral-200 hover:bg-neutral-100 dark:hover:bg-neutral-700 rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Manage Permissions
                        </a>
                        @endcan

                        @can('delete roles')
                        @if($role->name !== 'admin' && $role->users->count() === 0)
                        <form method="POST" action="{{ route('roles.destroy', $role) }}" class="mt-4"
                              x-data="{ confirmDelete: false }"
                              @submit.prevent="if(confirmDelete || confirm('Are you sure you want to delete this role? This action cannot be undone.')) $el.submit()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="block w-full px-4 py-2 text-left text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete Role
                            </button>
                        </form>
                        @endif
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
