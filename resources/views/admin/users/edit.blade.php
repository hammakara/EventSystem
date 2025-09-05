<x-layouts.dashboard title="Edit User">
    <!-- Ventixe Theme Animated Background Elements -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-32 h-32 bg-gradient-to-r from-purple-400/15 to-pink-400/15 rounded-full blur-xl animate-pulse" style="animation-duration: 6s;"></div>
        <div class="absolute top-40 right-20 w-24 h-24 bg-gradient-to-r from-indigo-400/15 to-purple-400/15 rounded-full blur-xl animate-bounce" style="animation-duration: 4s;"></div>
        <div class="absolute bottom-40 left-1/4 w-40 h-40 bg-gradient-to-r from-pink-400/15 to-rose-400/15 rounded-full blur-2xl animate-pulse" style="animation-duration: 5s;"></div>
        <div class="absolute bottom-20 right-1/3 w-28 h-28 bg-gradient-to-r from-violet-400/15 to-purple-400/15 rounded-full blur-xl animate-bounce" style="animation-duration: 7s;"></div>
    </div>

    <div class="relative px-6 py-8 max-w-4xl mx-auto">
        <!-- Clean Dashboard-Style Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <!-- User Avatar -->
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl blur-lg opacity-60 group-hover:opacity-100 transition-all duration-300"></div>
                            <div class="relative w-14 h-14 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-xl flex items-center justify-center shadow-2xl transform group-hover:scale-105 transition-all duration-300">
                                <span class="text-lg font-bold text-white drop-shadow-lg">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            </div>
                            @if($user->id === auth()->id())
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-slate-800 animate-pulse"></div>
                            @endif
                            <!-- Sparkle Effect -->
                            <div class="absolute -top-1 -right-1 w-3 h-3">
                                <div class="absolute inset-0 bg-yellow-400 rounded-full animate-ping opacity-75"></div>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-3xl lg:text-4xl font-black bg-gradient-to-r from-slate-800 via-indigo-600 to-purple-600 dark:from-white dark:via-indigo-400 dark:to-purple-400 bg-clip-text text-transparent">
                                Edit User
                            </h1>
                            <p class="text-lg text-slate-600 dark:text-slate-400 font-medium mt-1">Update {{ $user->name }}'s account information</p>
                        </div>
                    </div>
                            
                            <!-- Breadcrumb Navigation -->
                            <nav class="flex items-center gap-2 text-sm">
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-1.5 text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-all duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z"/>
                                    </svg>
                                    Dashboard
                                </a>
                                <svg class="w-4 h-4 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                <a href="{{ route('users.index') }}" class="px-3 py-1.5 text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-all duration-200">
                                    Users
                                </a>
                                <svg class="w-4 h-4 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                <a href="{{ route('users.show', $user) }}" class="px-3 py-1.5 text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-all duration-200">
                                    {{ $user->name }}
                                </a>
                                <svg class="w-4 h-4 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                <span class="px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300 rounded-lg font-medium">Edit</span>
                            </nav>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex items-center gap-3">
                            <a href="{{ route('users.show', $user) }}" 
                               class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white font-semibold rounded-xl shadow-lg shadow-slate-500/25 hover:shadow-slate-500/40 transition-all duration-300 transform hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-400 to-slate-500 rounded-xl blur opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                                <svg class="w-4 h-4 mr-2 relative z-10 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span class="relative z-10">View User</span>
                            </a>
                            <a href="{{ route('users.index') }}" 
                               class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 hover:from-purple-700 hover:via-indigo-700 hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-purple-500/25 hover:shadow-purple-500/40 transition-all duration-300 transform hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-400 via-indigo-400 to-blue-400 rounded-xl blur opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                                <svg class="w-4 h-4 mr-2 relative z-10 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                <span class="relative z-10">Back to Users</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Form -->
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Update User Information</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Modify user account details and permissions</p>
                </div>
                
                <form method="POST" action="{{ route('users.update', $user) }}" class="p-6 space-y-8">
                    @csrf
                    @method('PATCH')

                    <!-- Personal Information Section -->
                    <div class="space-y-6">
                        <div class="pb-4 border-b border-slate-200 dark:border-slate-700">
                            <h4 class="text-md font-medium text-slate-900 dark:text-white">Personal Information</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Update basic user details and contact information</p>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       required
                                       placeholder="Enter full name"
                                       class="block w-full px-3 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 placeholder-slate-400 @error('name') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                @error('name')
                                    <p class="text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       required
                                       placeholder="user@example.com"
                                       class="block w-full px-3 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 placeholder-slate-400 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                @error('email')
                                    <p class="text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div class="space-y-6">
                        <div class="pb-4 border-b border-slate-200 dark:border-slate-700">
                            <h4 class="text-md font-medium text-slate-900 dark:text-white">Security</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Update password (leave blank to keep current password)</p>
                        </div>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Password -->
                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    New Password
                                    <span class="text-xs text-slate-500 dark:text-slate-400 font-normal">(optional)</span>
                                </label>
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       placeholder="Enter new password or leave blank"
                                       class="block w-full px-3 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 placeholder-slate-400 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror">
                                @error('password')
                                    <p class="text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-2">
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                    Confirm Password
                                </label>
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       placeholder="Confirm new password"
                                       class="block w-full px-3 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 placeholder-slate-400">
                            </div>
                        </div>
                    </div>

                    <!-- Current Roles Display -->
                    <div class="space-y-6">
                        <div class="pb-4 border-b border-slate-200 dark:border-slate-700">
                            <h4 class="text-md font-medium text-slate-900 dark:text-white">Current Roles</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Currently assigned roles and permissions</p>
                        </div>
                        
                        <div class="bg-slate-50 dark:bg-slate-900/50 rounded-lg p-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($user->roles as $role)
                                    @php
                                        $roleColors = [
                                            'admin' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                            'organizer' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                            'attendee' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300'
                                        ];
                                        $roleColor = $roleColors[$role->name] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300';
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium {{ $roleColor }}">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        {{ ucfirst($role->name) }}
                                    </span>
                                @endforeach
                                @if($user->roles->isEmpty())
                                    <div class="flex items-center text-slate-500 dark:text-slate-400">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        <span class="text-sm">No roles currently assigned</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Roles Section -->
                    <div class="space-y-6">
                        <div class="pb-4 border-b border-slate-200 dark:border-slate-700">
                            <h4 class="text-md font-medium text-slate-900 dark:text-white">Update Permissions & Roles</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Modify user access levels by assigning or removing roles</p>
                        </div>
                        
                        <div class="space-y-4">
                            @foreach($roles as $role)
                                <label class="relative flex items-start p-4 bg-slate-50 dark:bg-slate-900/50 rounded-lg border border-slate-200 dark:border-slate-700 cursor-pointer hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors duration-200">
                                    <input type="checkbox" 
                                           name="roles[]" 
                                           value="{{ $role->name }}"
                                           {{ in_array($role->name, old('roles', $user->roles->pluck('name')->toArray())) ? 'checked' : '' }}
                                           class="mt-1 rounded border-slate-300 dark:border-slate-600 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0">
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="font-medium text-slate-900 dark:text-white">
                                                {{ ucfirst($role->name) }}
                                            </span>
                                            @php
                                                $roleColors = [
                                                    'admin' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                                    'organizer' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                                    'attendee' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300'
                                                ];
                                                $roleColor = $roleColors[$role->name] ?? 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300';
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium {{ $roleColor }}">
                                                {{ ucfirst($role->name) }}
                                            </span>
                                        </div>
                                        @if($role->permissions->count() > 0)
                                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                                                {{ $role->permissions->count() }} permissions included
                                            </p>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                            @error('roles')
                                <p class="text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                        <a href="{{ route('users.show', $user) }}" 
                           class="group relative px-6 py-3 bg-gradient-to-r from-slate-200 to-slate-300 hover:from-slate-300 hover:to-slate-400 dark:from-slate-700 dark:to-slate-600 dark:hover:from-slate-600 dark:hover:to-slate-500 text-slate-700 dark:text-slate-200 font-semibold rounded-xl shadow-lg shadow-slate-500/20 hover:shadow-slate-500/30 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-4 h-4 inline mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancel
                        </a>
                        <button type="submit" 
                                class="group relative px-8 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white font-bold rounded-xl shadow-2xl shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                            <!-- Multi-layer Glow Effect -->
                            <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl blur-lg opacity-70 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <div class="relative flex items-center">
                                <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition-transform duration-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                <span class="tracking-wide">Update User</span>
                            </div>
                            
                            <!-- Floating Sparkles -->
                            <div class="absolute -top-2 -right-2 w-4 h-4">
                                <div class="absolute inset-0 bg-yellow-400 rounded-full animate-ping opacity-75"></div>
                                <div class="absolute inset-0 bg-yellow-300 rounded-full animate-pulse"></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
