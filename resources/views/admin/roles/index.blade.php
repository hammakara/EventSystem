<x-layouts.dashboard title="Role Management">
    <div class="px-4 py-6 space-y-6">
        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-neutral-900 dark:text-white">Role Management</h1>
                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                    Manage system roles and their permissions
                </p>
            </div>
            <div class="mt-4 sm:mt-0">
                @role('admin')
                <a href="{{ route('roles.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Create Role
                </a>
                @endrole
            </div>
        </div>

        <!-- Roles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($roles as $role)
                <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 hover:shadow-lg transition-shadow duration-200">
                    <!-- Role Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full {{ $role->name === 'admin' ? 'bg-red-100 dark:bg-red-900' : ($role->name === 'organizer' ? 'bg-blue-100 dark:bg-blue-900' : 'bg-green-100 dark:bg-green-900') }} flex items-center justify-center">
                                    @if($role->name === 'admin')
                                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    @elseif($role->name === 'organizer')
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 104 0V4h-4z"/>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white capitalize">{{ $role->name }}</h3>
                                <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $role->users_count }} {{ Str::plural('user', $role->users_count) }}</p>
                            </div>
                        </div>
                        
                        <!-- Role Badge -->
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            {{ $role->name === 'admin' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : 
                               ($role->name === 'organizer' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 
                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300') }}">
                            {{ ucfirst($role->name) }}
                        </span>
                    </div>

                    <!-- Permissions Summary -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-sm text-neutral-600 dark:text-neutral-400 mb-2">
                            <span>Permissions</span>
                            <span>{{ $role->permissions->count() }} total</span>
                        </div>
                        @if($role->permissions->count() > 0)
                            <div class="flex flex-wrap gap-1">
                                @foreach($role->permissions->take(3) as $permission)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-neutral-100 text-neutral-800 dark:bg-neutral-700 dark:text-neutral-200">
                                        {{ $permission->name }}
                                    </span>
                                @endforeach
                                @if($role->permissions->count() > 3)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-neutral-100 text-neutral-800 dark:bg-neutral-700 dark:text-neutral-200">
                                        +{{ $role->permissions->count() - 3 }} more
                                    </span>
                                @endif
                            </div>
                        @else
                            <p class="text-sm text-neutral-400 dark:text-neutral-500">No permissions assigned</p>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-neutral-200 dark:border-neutral-700">
                        <div class="flex space-x-2">
                            @role('admin')
                            <a href="{{ route('roles.show', $role) }}" 
                               class="text-neutral-400 hover:text-neutral-600 dark:hover:text-neutral-300 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('roles.edit', $role) }}" 
                               class="text-violet-400 hover:text-violet-600 dark:hover:text-violet-300 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            @endrole
                        </div>

                        @role('admin')
                        @if($role->name !== 'admin')
                        <form method="POST" action="{{ route('roles.destroy', $role) }}" class="inline-block"
                              x-data="{ confirmDelete: false }"
                              @submit.prevent="if(confirmDelete || confirm('Are you sure you want to delete this role?')) $el.submit()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-400 hover:text-red-600 dark:hover:text-red-300 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                        @endif
                        @endrole
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-neutral-300 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-neutral-900 dark:text-white">No roles found</h3>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Get started by creating a new role.</p>
                        @role('admin')
                        <div class="mt-6">
                            <a href="{{ route('roles.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Create Role
                            </a>
                        </div>
                        @endrole
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.dashboard>
