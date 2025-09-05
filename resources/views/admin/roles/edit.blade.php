<x-layouts.dashboard title="Edit Role">
    <div class="px-4 py-6 space-y-6">
        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-neutral-900 dark:text-white">Edit Role: {{ ucfirst($role->name) }}</h1>
                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                    Update role information and permissions
                </p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-2">
                <a href="{{ route('roles.show', $role) }}" 
                   class="inline-flex items-center px-4 py-2 bg-neutral-200 hover:bg-neutral-300 dark:bg-neutral-600 dark:hover:bg-neutral-500 text-neutral-700 dark:text-neutral-200 text-sm font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    View Role
                </a>
                <a href="{{ route('roles.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-neutral-200 hover:bg-neutral-300 dark:bg-neutral-600 dark:hover:bg-neutral-500 text-neutral-700 dark:text-neutral-200 text-sm font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Roles
                </a>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700">
            <form method="POST" action="{{ route('roles.update', $role) }}" class="p-6 space-y-6">
                @csrf
                @method('PATCH')

                <!-- Role Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                            Role Name
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $role->name) }}" 
                               required
                               {{ $role->name === 'admin' ? 'readonly' : '' }}
                               class="mt-1 block w-full rounded-lg border-neutral-300 dark:border-neutral-600 dark:bg-neutral-700 focus:border-violet-500 focus:ring-violet-500 @error('name') border-red-500 @enderror {{ $role->name === 'admin' ? 'bg-neutral-100 dark:bg-neutral-600 cursor-not-allowed' : '' }}">
                        @if($role->name === 'admin')
                            <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">Admin role name cannot be changed</p>
                        @endif
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Guard Name -->
                    <div>
                        <label for="guard_name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">
                            Guard Name
                        </label>
                        <input type="text" 
                               name="guard_name" 
                               id="guard_name" 
                               value="{{ old('guard_name', $role->guard_name) }}"
                               class="mt-1 block w-full rounded-lg border-neutral-300 dark:border-neutral-600 dark:bg-neutral-700 focus:border-violet-500 focus:ring-violet-500 @error('guard_name') border-red-500 @enderror">
                        @error('guard_name')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Current Permissions Display -->
                <div class="bg-neutral-50 dark:bg-neutral-700 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">Current Permissions</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($role->permissions as $permission)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                {{ $permission->name }}
                            </span>
                        @endforeach
                        @if($role->permissions->isEmpty())
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">No permissions assigned</span>
                        @endif
                    </div>
                </div>

                <!-- Permissions -->
                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-4">
                        Update Permissions
                    </label>
                    
                    @if($permissions->isNotEmpty())
                        <div class="space-y-6">
                            @foreach($permissions as $category => $categoryPermissions)
                                <div class="bg-neutral-50 dark:bg-neutral-700 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="text-sm font-medium text-neutral-900 dark:text-white capitalize">
                                            {{ $category }} Permissions
                                        </h3>
                                        <button type="button" 
                                                class="text-xs text-violet-600 dark:text-violet-400 hover:text-violet-700 dark:hover:text-violet-300"
                                                x-data="{ category: '{{ $category }}' }"
                                                @click="
                                                    const checkboxes = document.querySelectorAll(`input[name='permissions[]'][data-category='${category}']`);
                                                    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                                                    checkboxes.forEach(cb => cb.checked = !allChecked);
                                                ">
                                            Toggle All
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                        @foreach($categoryPermissions as $permission)
                                            <label class="flex items-center">
                                                <input type="checkbox" 
                                                       name="permissions[]" 
                                                       value="{{ $permission->name }}"
                                                       data-category="{{ $category }}"
                                                       {{ in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }}
                                                       class="rounded border-neutral-300 dark:border-neutral-600 text-violet-600 focus:ring-violet-500">
                                                <span class="ml-2 text-sm text-neutral-900 dark:text-white">
                                                    {{ $permission->name }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-8 w-8 text-neutral-300 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">No permissions available</p>
                        </div>
                    @endif

                    @error('permissions')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                    <a href="{{ route('roles.show', $role) }}" 
                       class="px-4 py-2 bg-neutral-200 hover:bg-neutral-300 dark:bg-neutral-600 dark:hover:bg-neutral-500 text-neutral-700 dark:text-neutral-200 text-sm font-medium rounded-lg transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-violet-600 hover:bg-violet-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.dashboard>
