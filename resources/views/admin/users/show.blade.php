<x-layouts.dashboard title="View User">
    <!-- Ventixe Theme Animated Background Elements -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-20 left-10 w-32 h-32 bg-gradient-to-r from-purple-400/15 to-pink-400/15 rounded-full blur-xl animate-pulse" style="animation-duration: 6s;"></div>
        <div class="absolute top-40 right-20 w-24 h-24 bg-gradient-to-r from-indigo-400/15 to-purple-400/15 rounded-full blur-xl animate-bounce" style="animation-duration: 4s;"></div>
        <div class="absolute bottom-40 left-1/4 w-40 h-40 bg-gradient-to-r from-pink-400/15 to-rose-400/15 rounded-full blur-2xl animate-pulse" style="animation-duration: 5s;"></div>
        <div class="absolute bottom-20 right-1/3 w-28 h-28 bg-gradient-to-r from-violet-400/15 to-purple-400/15 rounded-full blur-xl animate-bounce" style="animation-duration: 7s;"></div>
    </div>

    <div class="relative px-6 py-8 max-w-6xl mx-auto">
        <!-- Clean Dashboard-Style Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div class="space-y-4">
                    <div class="flex items-center gap-6">
                        <!-- Enhanced User Avatar -->
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl blur-xl opacity-60 group-hover:opacity-100 transition-all duration-500"></div>
                            <div class="relative w-20 h-20 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-2xl transform group-hover:scale-105 group-hover:rotate-3 transition-all duration-500">
                                <span class="text-2xl font-bold text-white drop-shadow-lg">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            </div>
                            @if($user->id === auth()->id())
                                <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full border-3 border-white dark:border-slate-800 flex items-center justify-center animate-pulse">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            @endif
                            <!-- Enhanced Status Indicator -->
                            <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2">
                                <div class="px-3 py-1 bg-gradient-to-r from-green-400 to-emerald-500 text-white text-xs font-bold rounded-full shadow-lg shadow-green-500/30 animate-pulse">
                                    Active
                                </div>
                            </div>
                            <!-- Sparkle Effects -->
                            <div class="absolute -top-1 -right-1 w-4 h-4">
                                <div class="absolute inset-0 bg-yellow-400 rounded-full animate-ping opacity-75"></div>
                            </div>
                        </div>
                        <div>
                            <h1 class="text-3xl lg:text-4xl font-black bg-gradient-to-r from-slate-800 via-indigo-600 to-purple-600 dark:from-white dark:via-indigo-400 dark:to-purple-400 bg-clip-text text-transparent">{{ $user->name }}</h1>
                            <p class="text-lg text-slate-600 dark:text-slate-400 font-medium mt-1">{{ $user->email }}</p>
                                    <div class="flex items-center gap-4 mt-2">
                                        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4m-3 8V9a1 1 0 00-1-1h-4a1 1 0 00-1 1v6a1 1 0 001 1h4a1 1 0 001-1z"/>
                                            </svg>
                                            <span>ID: {{ $user->id }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span>Joined {{ $user->created_at->format('M d, Y') }}</span>
                                        </div>
                                        @if($user->id === auth()->id())
                                            <div class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full">
                                                Your Account
                                            </div>
                                        @endif
                                    </div>
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
                                <span class="px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-300 rounded-lg font-medium">{{ $user->name }}</span>
                            </nav>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex items-center gap-3">
                            @role('admin')
                            <a href="{{ route('users.edit', $user) }}" 
                               class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white font-bold rounded-xl shadow-2xl shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                                <!-- Multi-layer Glow Effect -->
                                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl blur-lg opacity-70 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <div class="relative flex items-center">
                                    <svg class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    <span class="tracking-wide">Edit User</span>
                                </div>
                                
                                <!-- Floating Sparkles -->
                                <div class="absolute -top-2 -right-2 w-4 h-4">
                                    <div class="absolute inset-0 bg-yellow-400 rounded-full animate-ping opacity-75"></div>
                                    <div class="absolute inset-0 bg-yellow-300 rounded-full animate-pulse"></div>
                                </div>
                            </a>
                            @endrole
                            <a href="{{ route('users.index') }}" 
                               class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-slate-600 to-slate-700 hover:from-slate-700 hover:to-slate-800 text-white font-semibold rounded-xl shadow-lg shadow-slate-500/25 hover:shadow-slate-500/40 transition-all duration-300 transform hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-r from-slate-400 to-slate-500 rounded-xl blur opacity-0 group-hover:opacity-30 transition-opacity duration-300"></div>
                                <svg class="w-4 h-4 mr-2 relative z-10 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                <span class="relative z-10">Back to Users</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3 space-y-8">
                    <!-- Account Details Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Account Information</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Detailed user account information and settings</p>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <!-- Email Verification -->
                                <div class="space-y-2">
                                    <dt class="text-sm font-medium text-slate-700 dark:text-slate-300">Email Status</dt>
                                    <dd>
                                        @if($user->email_verified_at)
                                            <div class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Verified
                                            </div>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $user->email_verified_at->format('M d, Y') }}</p>
                                        @else
                                            <div class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                                Unverified
                                            </div>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Email needs verification</p>
                                        @endif
                                    </dd>
                                </div>

                                <!-- Account Created -->
                                <div class="space-y-2">
                                    <dt class="text-sm font-medium text-slate-700 dark:text-slate-300">Account Created</dt>
                                    <dd class="text-sm text-slate-900 dark:text-white font-medium">{{ $user->created_at->format('M d, Y') }}</dd>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $user->created_at->format('g:i A') }} • {{ $user->created_at->diffForHumans() }}</p>
                                </div>

                                <!-- Last Updated -->
                                <div class="space-y-2">
                                    <dt class="text-sm font-medium text-slate-700 dark:text-slate-300">Last Updated</dt>
                                    <dd class="text-sm text-slate-900 dark:text-white font-medium">{{ $user->updated_at->format('M d, Y') }}</dd>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $user->updated_at->format('g:i A') }} • {{ $user->updated_at->diffForHumans() }}</p>
                                </div>

                                <!-- User ID -->
                                <div class="space-y-2">
                                    <dt class="text-sm font-medium text-slate-700 dark:text-slate-300">User ID</dt>
                                    <dd class="text-sm text-slate-900 dark:text-white font-mono bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded inline-block">{{ $user->id }}</dd>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Unique identifier</p>
                                </div>

                                <!-- Total Roles -->
                                <div class="space-y-2">
                                    <dt class="text-sm font-medium text-slate-700 dark:text-slate-300">Assigned Roles</dt>
                                    <dd class="text-sm text-slate-900 dark:text-white font-medium">{{ $user->roles->count() }} {{ $user->roles->count() === 1 ? 'Role' : 'Roles' }}</dd>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">Access level permissions</p>
                                </div>

                                <!-- Account Status -->
                                <div class="space-y-2">
                                    <dt class="text-sm font-medium text-slate-700 dark:text-slate-300">Account Status</dt>
                                    <dd>
                                        <div class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                            Active
                                        </div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Account is active and accessible</p>
                                    </dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Permissions Card -->
                    @if($user->roles->isNotEmpty())
                    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Permissions & Access Rights</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Detailed permissions granted through assigned roles</p>
                        </div>
                        
                        <div class="p-6">
                            @php
                                $allPermissions = $user->getAllPermissions()->groupBy(function($permission) {
                                    return explode(' ', $permission->name)[1] ?? 'general';
                                });
                            @endphp
                            
                            <div class="space-y-6">
                                @foreach($allPermissions as $category => $permissions)
                                    <div>
                                        <h4 class="text-md font-medium text-slate-900 dark:text-white mb-3 flex items-center">
                                            <div class="w-2 h-2 bg-indigo-500 rounded-full mr-3"></div>
                                            {{ ucfirst($category) }} Permissions
                                            <span class="ml-2 px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs rounded-full">
                                                {{ $permissions->count() }}
                                            </span>
                                        </h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                            @foreach($permissions as $permission)
                                                <div class="flex items-center px-3 py-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span class="text-sm font-medium text-blue-800 dark:text-blue-300 truncate">
                                                        {{ $permission->name }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Roles Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Assigned Roles</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Current user access levels</p>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach($user->roles as $role)
                                    <div class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-lg border border-slate-200 dark:border-slate-700">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="font-semibold text-slate-900 dark:text-white">
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
                                        <div class="flex items-center text-sm text-slate-600 dark:text-slate-400">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            {{ $role->permissions->count() }} permissions
                                        </div>
                                    </div>
                                @endforeach
                                @if($user->roles->isEmpty())
                                    <div class="text-center py-8">
                                        <div class="mx-auto w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                        <h4 class="text-sm font-medium text-slate-900 dark:text-white">No Roles Assigned</h4>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">This user has no roles assigned yet</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Card -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Quick Actions</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Manage this user account</p>
                        </div>
                        
                        <div class="p-6">
                            <div class="space-y-3">
                                @role('admin')
                                <a href="{{ route('users.edit', $user) }}" 
                                   class="flex items-center w-full px-4 py-3 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors duration-200 border border-slate-200 dark:border-slate-700">
                                    <div class="flex items-center justify-center w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">Edit Profile</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Update user details and information</p>
                                    </div>
                                </a>

                                <a href="{{ route('users.edit', $user) }}#roles" 
                                   class="flex items-center w-full px-4 py-3 text-left bg-slate-50 dark:bg-slate-900/50 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-colors duration-200 border border-slate-200 dark:border-slate-700">
                                    <div class="flex items-center justify-center w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">Manage Roles</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Assign or remove user roles</p>
                                    </div>
                                </a>

                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $user) }}" class="w-full"
                                      x-data="{ confirmDelete: false }"
                                      @submit.prevent="if(confirmDelete || confirm('⚠️ Are you sure you want to delete {{ $user->name }}? This action cannot be undone.')) $el.submit()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="flex items-center w-full px-4 py-3 text-left bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition-colors duration-200 border border-red-200 dark:border-red-800">
                                        <div class="flex items-center justify-center w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-red-700 dark:text-red-300">Delete User</p>
                                            <p class="text-xs text-red-600 dark:text-red-400">Permanently remove this account</p>
                                        </div>
                                    </button>
                                </form>
                                @endif
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
