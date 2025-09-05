<x-layouts.dashboard title="User Management">
    <!-- Ventixe Dashboard Theme CSS -->
    <style>
        /* Ventixe Theme Keyframe Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            25% {
                transform: translateY(-10px) rotate(1deg);
            }

            50% {
                transform: translateY(-20px) rotate(0deg);
            }

            75% {
                transform: translateY(-10px) rotate(-1deg);
            }
        }

        @keyframes bounce-gentle {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        @keyframes gradient-x {

            0%,
            100% {
                background-size: 400% 400%;
                background-position: 0% 50%;
            }

            50% {
                background-size: 400% 400%;
                background-position: 100% 50%;
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        @keyframes progress-fill {
            0% {
                width: 0%;
            }

            100% {
                width: var(--progress-width, 85%);
            }
        }

        @keyframes progress-fill-reverse {
            0% {
                width: 0%;
                transform: translateX(100%);
            }

            100% {
                width: var(--progress-width, 75%);
                transform: translateX(0%);
            }
        }

        @keyframes slide-right {
            0% {
                width: 0%;
                transform: translateX(-100%);
            }

            100% {
                width: var(--progress-width, 60%);
                transform: translateX(0%);
            }
        }

        @keyframes wiggle {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(1deg);
            }

            75% {
                transform: rotate(-1deg);
            }
        }

        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0px);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: translateY(-25px);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0) rotate(0deg);
            }

            50% {
                opacity: 1;
                transform: scale(1) rotate(180deg);
            }
        }

        /* Apply animations */
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-bounce-gentle {
            animation: bounce-gentle 2s ease-in-out infinite;
        }

        .animate-gradient-x {
            animation: gradient-x 3s ease infinite;
        }

        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        .animate-progress-fill {
            animation: progress-fill 2s ease-out forwards;
        }

        .animate-progress-fill-reverse {
            animation: progress-fill-reverse 2s ease-out forwards;
        }

        .animate-slide-right {
            animation: slide-right 2s ease-out forwards;
        }

        .animate-wiggle {
            animation: wiggle 1s ease-in-out infinite;
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s infinite;
        }

        .animate-pulse-slow {
            animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Counter animation */
        .counter {
            transition: all 0.3s ease;
        }

        /* Stagger animations */
        .stagger-animation>* {
            animation-delay: calc(var(--stagger) * 150ms);
        }

        /* Morphing shapes */
        .morphing-bg {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient-x 15s ease infinite;
        }

        /* Glass morphism effect */
        .glass-morphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Hover effects */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.25);
        }

        /* Particle effect */
        .particle {
            position: absolute;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.8) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            animation: float 4s ease-in-out infinite;
        }

        /* Loading shimmer for stats */
        .stat-loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
    </style>

    <!-- Animated Background Elements -->
    <div class="fixed inset-0 pointer-events-none">
        <div
            class="absolute top-20 left-10 w-32 h-32 bg-gradient-to-r from-purple-400/15 to-pink-400/15 rounded-full blur-xl animate-float">
        </div>
        <div
            class="absolute top-40 right-20 w-24 h-24 bg-gradient-to-r from-indigo-400/15 to-purple-400/15 rounded-full blur-xl animate-pulse-slow">
        </div>
        <div
            class="absolute bottom-40 left-1/4 w-40 h-40 bg-gradient-to-r from-pink-400/15 to-rose-400/15 rounded-full blur-2xl animate-bounce-slow">
        </div>
        <div class="absolute bottom-20 right-1/3 w-28 h-28 bg-gradient-to-r from-violet-400/15 to-purple-400/15 rounded-full blur-xl animate-float"
            style="animation-delay: -2s;"></div>
        <div class="absolute top-1/2 left-1/2 w-36 h-36 bg-gradient-to-r from-fuchsia-400/10 to-violet-400/10 rounded-full blur-2xl animate-pulse"
            style="animation-delay: -3s;"></div>
    </div>

    <div class="relative px-6 py-8 max-w-7xl mx-auto">
        <!-- Clean Hero Header - Dashboard Style -->
        <div class="mb-12">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                <div class="space-y-6">
                    <!-- Animated Title Section -->
                    <div class="flex items-center gap-6">
                        <div class="group/icon relative">
                            <!-- Multi-layer Icon with Glow Effects -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl blur-xl opacity-60 group-hover/icon:opacity-100 group-hover/icon:scale-110 transition-all duration-500 animate-pulse">
                            </div>
                            <div
                                class="relative w-16 h-16 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-2xl transform group-hover/icon:scale-105 group-hover/icon:rotate-6 transition-all duration-500">
                                <svg class="w-8 h-8 text-white drop-shadow-lg animate-bounce-gentle" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>

                                <!-- Sparkle Effects -->
                                <div class="absolute -top-1 -right-1 w-3 h-3">
                                    <div class="absolute inset-0 bg-yellow-400 rounded-full animate-ping opacity-75">
                                    </div>
                                    <div class="absolute inset-0 bg-yellow-300 rounded-full animate-pulse"></div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <h1
                                class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-slate-800 via-indigo-600 to-purple-600 dark:from-white dark:via-blue-400 dark:to-purple-400 bg-clip-text text-transparent animate-gradient-x">
                                User Management
                            </h1>
                            <p class="text-lg text-slate-600 dark:text-slate-400 font-medium">
                                Complete control over user accounts, roles, and permissions
                            </p>

                            <!-- Animated Stats Counter -->
                            <div class="flex items-center gap-6 mt-4">
                                <div class="group/stat relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 to-green-500/20 rounded-2xl animate-pulse">
                                    </div>
                                    <div
                                        class="relative px-6 py-3 bg-emerald-50/80 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 rounded-2xl border border-emerald-200/50 dark:border-emerald-700/50 shadow-lg backdrop-blur-sm">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse shadow-lg shadow-emerald-500/50">
                                            </div>
                                            <span class="font-bold text-2xl tabular-nums counter"
                                                data-target="{{ $users->total() }}">0</span>
                                            <span class="text-sm opacity-80">Active Users</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="group/stat relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-indigo-500/20 rounded-2xl animate-pulse delay-300">
                                    </div>
                                    <div
                                        class="relative px-6 py-3 bg-blue-50/80 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-2xl border border-blue-200/50 dark:border-blue-700/50 shadow-lg backdrop-blur-sm">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-3 h-3 bg-blue-500 rounded-full animate-bounce shadow-lg shadow-blue-500/50">
                                            </div>
                                            <span class="font-bold text-2xl tabular-nums counter"
                                                data-target="{{ $roles->count() }}">0</span>
                                            <span class="text-sm opacity-80">Roles</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Breadcrumb with Animations -->
                    <nav class="flex items-center gap-2 text-sm">
                        <a href="{{ route('admin.dashboard') }}"
                            class="group flex items-center gap-2 px-4 py-2 text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 animate-pulse" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <div
                            class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl font-semibold shadow-lg shadow-indigo-500/25 animate-shimmer">
                            Users
                        </div>
                    </nav>
                </div>

                @role('admin')
                    <!-- Spectacular Action Button -->
                    <div class="relative group/btn">
                        <!-- Multi-layer Button Glow -->
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-2xl blur-lg opacity-70 group-hover/btn:opacity-100 transition-opacity duration-500 animate-pulse">
                        </div>
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl opacity-50 group-hover/btn:opacity-100 transition-opacity duration-300">
                        </div>

                        <a href="{{ route('users.create') }}"
                            class="relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white font-bold rounded-2xl shadow-2xl shadow-indigo-500/30 transition-all duration-500 transform hover:scale-105 hover:-translate-y-1 group-hover/btn:shadow-indigo-500/50">
                            <!-- Animated Icon -->
                            <svg class="w-6 h-6 mr-3 group-hover/btn:rotate-180 transition-transform duration-700"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span class="text-lg font-bold tracking-wide">Create New User</span>

                            <!-- Floating Sparkles -->
                            <div class="absolute -top-2 -right-2 w-4 h-4">
                                <div class="absolute inset-0 bg-yellow-400 rounded-full animate-ping opacity-75"></div>
                                <div class="absolute inset-0 bg-yellow-300 rounded-full animate-pulse"></div>
                            </div>
                            <div class="absolute -bottom-1 -left-1 w-3 h-3">
                                <div class="absolute inset-0 bg-pink-400 rounded-full animate-bounce opacity-75"></div>
                            </div>
                        </a>
                    </div>
                @endrole
            </div>
        </div>
    </div>

    @role('admin')
        <!-- Spectacular Animated Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Total Users Card with Advanced Animations -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-blue-50/80 to-indigo-100/80 dark:from-blue-900/20 dark:to-indigo-900/30 backdrop-blur-xl rounded-3xl border border-blue-200/50 dark:border-blue-700/30 shadow-xl shadow-blue-500/10 hover:shadow-2xl hover:shadow-blue-500/30 transition-all duration-700 transform hover:scale-105 hover:-translate-y-2 hover:rotate-1">
                <!-- Animated Background Gradient -->
                <div
                    class="absolute inset-0 bg-gradient-to-br from-blue-400/10 via-indigo-400/10 to-purple-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                </div>

                <!-- Floating Orbs -->
                <div
                    class="absolute -top-4 -right-4 w-20 h-20 bg-gradient-to-br from-blue-400/20 to-indigo-400/20 rounded-full blur-xl animate-pulse group-hover:animate-bounce">
                </div>
                <div
                    class="absolute -bottom-2 -left-2 w-12 h-12 bg-gradient-to-br from-indigo-400/20 to-purple-400/20 rounded-full blur-lg animate-float">
                </div>

                <div class="relative z-10 p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div class="space-y-3">
                            <p
                                class="text-sm font-bold text-blue-600 dark:text-blue-400 uppercase tracking-wider animate-pulse">
                                Total Users
                            </p>
                            <div class="flex items-baseline gap-2">
                                <p class="text-4xl font-black text-slate-800 dark:text-white tabular-nums group-hover:scale-110 transition-transform duration-500 counter-stat"
                                    data-target="{{ $users->total() }}">0</p>
                                <div
                                    class="flex items-center gap-1 px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full text-xs font-medium animate-bounce">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    <span>Active</span>
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-2">
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-ping"></div>
                            <span>All registered accounts</span>
                            </p>
                        </div>

                        <!-- Animated Icon with Multiple Effects -->
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-blue-500 rounded-2xl blur-xl opacity-40 group-hover:opacity-70 transition-opacity duration-700 animate-pulse">
                            </div>
                            <div
                                class="relative w-16 h-16 bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-2xl group-hover:rotate-12 group-hover:scale-110 transition-all duration-700">
                                <svg class="w-8 h-8 text-white group-hover:animate-bounce" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>

                                <!-- Sparkle Effects -->
                                <div class="absolute -top-1 -right-1 w-3 h-3">
                                    <div class="absolute inset-0 bg-yellow-400 rounded-full animate-ping"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar Animation -->
                    <div class="w-full bg-blue-200/30 dark:bg-blue-800/30 rounded-full h-2 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full animate-progress-fill"
                            style="width: 85%;"></div>
                    </div>
                </div>
            </div>

            <!-- New Users Card with Slide-in Animation -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-emerald-50/80 to-green-100/80 dark:from-emerald-900/20 dark:to-green-900/30 backdrop-blur-xl rounded-3xl border border-emerald-200/50 dark:border-emerald-700/30 shadow-xl shadow-emerald-500/10 hover:shadow-2xl hover:shadow-emerald-500/30 transition-all duration-700 transform hover:scale-105 hover:-translate-y-2 hover:-rotate-1">
                <!-- Animated Background -->
                <div
                    class="absolute inset-0 bg-gradient-to-br from-emerald-400/10 via-green-400/10 to-teal-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                </div>

                <!-- Floating Elements -->
                <div
                    class="absolute -top-3 -left-3 w-16 h-16 bg-gradient-to-br from-emerald-400/20 to-green-400/20 rounded-full blur-xl animate-bounce group-hover:animate-ping">
                </div>
                <div
                    class="absolute -bottom-4 -right-4 w-24 h-24 bg-gradient-to-br from-green-400/20 to-teal-400/20 rounded-full blur-2xl animate-pulse">
                </div>

                <div class="relative z-10 p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div class="space-y-3">
                            <p
                                class="text-sm font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider animate-pulse">
                                New This Week
                            </p>
                            <div class="flex items-baseline gap-2">
                                <p
                                    class="text-4xl font-black text-slate-800 dark:text-white tabular-nums group-hover:scale-110 transition-transform duration-500">
                                    +{{ $users->where('created_at', '>=', now()->subDays(7))->count() }}</p>
                                <div
                                    class="flex items-center gap-1 px-2 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-full text-xs font-medium animate-wiggle">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <span>Growth</span>
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-2">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                            <span>Recent registrations</span>
                            </p>
                        </div>

                        <!-- Rotating Icon -->
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-emerald-500 rounded-2xl blur-xl opacity-40 group-hover:opacity-70 transition-opacity duration-700 animate-pulse">
                            </div>
                            <div
                                class="relative w-16 h-16 bg-gradient-to-br from-emerald-500 via-green-500 to-teal-500 rounded-2xl flex items-center justify-center shadow-2xl group-hover:-rotate-12 group-hover:scale-110 transition-all duration-700">
                                <svg class="w-8 h-8 text-white group-hover:animate-spin" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Animated Progress Ring -->
                    <div class="w-full bg-emerald-200/30 dark:bg-emerald-800/30 rounded-full h-2 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-emerald-500 to-green-500 rounded-full animate-slide-right"
                            style="width: 60%;"></div>
                    </div>
                </div>
            </div>

            <!-- Active Roles Card with Bounce Animation -->
            <div
                class="group relative overflow-hidden bg-gradient-to-br from-violet-50/80 to-purple-100/80 dark:from-violet-900/20 dark:to-purple-900/30 backdrop-blur-xl rounded-3xl border border-violet-200/50 dark:border-violet-700/30 shadow-xl shadow-violet-500/10 hover:shadow-2xl hover:shadow-violet-500/30 transition-all duration-700 transform hover:scale-105 hover:-translate-y-2 hover:rotate-1">
                <!-- Dynamic Background -->
                <div
                    class="absolute inset-0 bg-gradient-to-br from-violet-400/10 via-purple-400/10 to-pink-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                </div>

                <!-- Floating Decorations -->
                <div
                    class="absolute -top-2 -right-2 w-14 h-14 bg-gradient-to-br from-violet-400/20 to-purple-400/20 rounded-full blur-lg animate-float group-hover:animate-bounce">
                </div>
                <div
                    class="absolute -bottom-3 -left-3 w-18 h-18 bg-gradient-to-br from-purple-400/20 to-pink-400/20 rounded-full blur-xl animate-pulse">
                </div>

                <div class="relative z-10 p-8">
                    <div class="flex items-start justify-between mb-6">
                        <div class="space-y-3">
                            <p
                                class="text-sm font-bold text-violet-600 dark:text-violet-400 uppercase tracking-wider animate-pulse">
                                Active Roles
                            </p>
                            <div class="flex items-baseline gap-2">
                                <p
                                    class="text-4xl font-black text-slate-800 dark:text-white tabular-nums group-hover:scale-110 transition-transform duration-500">
                                    {{ $roles->count() }}</p>
                                <div
                                    class="flex items-center gap-1 px-2 py-1 bg-violet-100 dark:bg-violet-900/30 text-violet-700 dark:text-violet-300 rounded-full text-xs font-medium animate-bounce">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>System</span>
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-2">
                            <div class="w-2 h-2 bg-violet-500 rounded-full animate-ping"></div>
                            <span>Permission groups</span>
                            </p>
                        </div>

                        <!-- Pulsing Shield Icon -->
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-violet-500 rounded-2xl blur-xl opacity-40 group-hover:opacity-70 transition-opacity duration-700 animate-pulse">
                            </div>
                            <div
                                class="relative w-16 h-16 bg-gradient-to-br from-violet-500 via-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-2xl group-hover:rotate-6 group-hover:scale-110 transition-all duration-700">
                                <svg class="w-8 h-8 text-white group-hover:animate-pulse" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Animated Security Bar -->
                    <div class="w-full bg-violet-200/30 dark:bg-violet-800/30 rounded-full h-2 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-violet-500 to-purple-500 rounded-full animate-progress-fill-reverse"
                            style="width: 75%;"></div>
                    </div>
                </div>
            </div>
        </div>
    @endrole

    <!-- Spectacular Search & Filter Section -->
    <div
        class="group relative overflow-hidden bg-gradient-to-br from-white/90 via-white/80 to-slate-50/90 dark:from-slate-800/90 dark:via-slate-800/80 dark:to-slate-900/90 backdrop-blur-2xl rounded-2xl border border-slate-200/50 dark:border-slate-700/30 shadow-2xl shadow-slate-900/5 mb-8">
        <!-- Animated Background Elements -->
        <div
            class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 via-purple-500/5 to-pink-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
        </div>
        <div
            class="absolute -top-10 -right-10 w-40 h-40 bg-gradient-to-br from-indigo-400/10 to-purple-400/10 rounded-full blur-3xl animate-pulse">
        </div>
        <div
            class="absolute -bottom-5 -left-5 w-32 h-32 bg-gradient-to-br from-purple-400/10 to-pink-400/10 rounded-full blur-2xl animate-float">
        </div>

        {{-- <div class="relative">


            <form method="GET" action="{{ route('users.index') }}" class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Enhanced Search Input -->
                    <div class="lg:col-span-6 group/input">
                        <label for="search"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                            Search Users
                        </label>
                        <div class="relative">
                            <!-- Multiple Icon Layers -->
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <div class="relative">
                                    <svg class="h-5 w-5 text-slate-400 group-focus-within/input:text-indigo-500 transition-colors duration-300 group-focus-within/input:animate-pulse"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Search by name or email..."
                                class="w-full pl-12 pr-4 py-4 bg-slate-50/80 dark:bg-slate-900/80 backdrop-blur-sm border-2 border-slate-300/50 dark:border-slate-600/50 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-300 placeholder-slate-400 text-slate-900 dark:text-white font-medium shadow-inner hover:shadow-lg">

                            <!-- Animated Border -->
                            <div
                                class="absolute inset-0 rounded-xl bg-gradient-to-r from-indigo-500/20 via-purple-500/20 to-pink-500/20 opacity-0 group-focus-within/input:opacity-100 transition-opacity duration-300 -z-10 blur-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Role Filter -->
                    <div class="lg:col-span-4 group/select">
                        <label for="role"
                            class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                            Filter by Role
                        </label>
                        <div class="relative">
                            <select name="role" id="role"
                                class="w-full px-4 py-4 bg-slate-50/80 dark:bg-slate-900/80 backdrop-blur-sm border-2 border-slate-300/50 dark:border-slate-600/50 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-300 text-slate-900 dark:text-white font-medium shadow-inner hover:shadow-lg appearance-none cursor-pointer">
                                <option value="">All Roles</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ request('role') === $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Custom Dropdown Arrow -->
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within/select:text-indigo-500 transition-colors duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                </svg>
                            </div>

                            <!-- Animated Border -->
                            <div
                                class="absolute inset-0 rounded-xl bg-gradient-to-r from-purple-500/20 via-pink-500/20 to-rose-500/20 opacity-0 group-focus-within/select:opacity-100 transition-opacity duration-300 -z-10 blur-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Spectacular Action Buttons -->
                    <div class="lg:col-span-2 flex flex-col justify-end">
                        <div class="flex gap-3">
                            <!-- Search Button with Multiple Effects -->
                            <button type="submit"
                                class="group/btn relative flex-1 px-6 py-4 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:via-purple-700 hover:to-pink-700 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-xl shadow-indigo-500/30 hover:shadow-indigo-500/50">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 rounded-xl blur-lg opacity-0 group-hover/btn:opacity-50 transition-opacity duration-300">
                                </div>
                                <div class="relative flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4 group-hover/btn:animate-spin" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <span>Search</span>
                                </div>

                                <!-- Sparkle Effect -->
                                <div class="absolute -top-1 -right-1 w-3 h-3">
                                    <div class="absolute inset-0 bg-yellow-400 rounded-full animate-ping opacity-75">
                                    </div>
                                </div>
                            </button>

                            @if (request()->hasAny(['search', 'role']))
                                <!-- Clear Button with Slide Animation -->
                                <a href="{{ route('users.index') }}"
                                    class="group/clear relative px-4 py-4 bg-slate-200/80 hover:bg-slate-300/80 dark:bg-slate-700/80 dark:hover:bg-slate-600/80 text-slate-700 dark:text-slate-200 font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg backdrop-blur-sm border border-slate-300/50 dark:border-slate-600/50">
                                    <div class="flex items-center justify-center">
                                        <svg class="w-4 h-4 group-hover/clear:animate-bounce" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div> --}}
    </div>

    <!-- Professional Users List -->
    <div
        class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">All Users</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">{{ $users->total() }} users total</p>
                </div>
                @if (request()->hasAny(['search', 'role']))
                    <div class="text-sm text-slate-600 dark:text-slate-400">
                        Showing filtered results
                    </div>
                @endif
            </div>
        </div>

        <div class="divide-y divide-slate-200 dark:divide-slate-700">
            @forelse($users as $user)
                <div class="p-6 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors duration-200">
                    <div class="flex items-center justify-between">
                        <!-- User Info Section -->
                        <div class="flex items-center gap-4">
                            <!-- Professional Avatar -->
                            <div class="relative">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md">
                                    <span class="text-lg font-bold text-white">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </span>
                                </div>
                                @if ($user->id === auth()->id())
                                    <div
                                        class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-slate-800">
                                    </div>
                                @endif
                            </div>

                            <!-- User Details -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-1">
                                    <h4 class="text-lg font-semibold text-slate-900 dark:text-white truncate">
                                        {{ $user->name }}
                                    </h4>
                                    @if ($user->id === auth()->id())
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                            You
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-400 truncate">
                                    {{ $user->email }}
                                </p>
                                <div class="flex items-center gap-4 mt-2">
                                    <p class="text-xs text-slate-500 dark:text-slate-400">
                                        Joined {{ $user->created_at->format('M d, Y') }}
                                    </p>
                                    <!-- Role Badges -->
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($user->roles as $role)
                                            @php
                                                $roleColors = [
                                                    'admin' =>
                                                        'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                                    'organizer' =>
                                                        'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
                                                    'attendee' =>
                                                        'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                                ];
                                                $roleColor =
                                                    $roleColors[$role->name] ??
                                                    'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300';
                                            @endphp
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium {{ $roleColor }}">
                                                {{ ucfirst($role->name) }}
                                            </span>
                                        @empty
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300">
                                                No role assigned
                                            </span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @role('admin')
                            <div class="flex items-center gap-2 ml-4">
                                <!-- View Button -->
                                <a href="{{ route('users.show', $user) }}"
                                    class="p-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-400 rounded-lg transition-colors duration-200 tooltip"
                                    title="View Details">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <!-- Edit Button -->
                                <a href="{{ route('users.edit', $user) }}"
                                    class="p-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-400 rounded-lg transition-colors duration-200 tooltip"
                                    title="Edit User">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <!-- Delete Button -->
                                @if ($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('users.destroy', $user) }}"
                                        class="inline-block" x-data="{ confirmDelete: false }"
                                        @submit.prevent="if(confirmDelete || confirm('Are you sure you want to delete {{ $user->name }}? This action cannot be undone.')) $el.submit()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2.5 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 text-red-600 dark:text-red-400 rounded-lg transition-colors duration-200 tooltip"
                                            title="Delete User">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endrole
                    </div>
                </div>
            @empty
                <!-- Professional Empty State -->
                <div class="p-16 text-center">
                    <div
                        class="mx-auto w-20 h-20 bg-slate-100 dark:bg-slate-700 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-slate-400 dark:text-slate-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 dark:text-white mb-2">No users found</h3>
                    <p class="text-slate-600 dark:text-slate-400 max-w-sm mx-auto mb-6">
                        @if (request()->hasAny(['search', 'role']))
                            No users match your current search criteria. Try adjusting your filters or search terms.
                        @else
                            There are no users in the system yet. Create the first user to get started.
                        @endif
                    </p>
                    @if (request()->hasAny(['search', 'role']))
                        <a href="{{ route('users.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Clear Filters
                        </a>
                    @else
                        @role('admin')
                            <a href="{{ route('users.create') }}"
                                class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-colors duration-200 shadow-sm">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create First User
                            </a>
                        @endrole
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Professional Pagination -->
        @if ($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                {{ $users->withQueryString()->links() }}
            </div>
        @endif
    </div>
    </div>
    </div>

    <!-- Advanced JavaScript for Animations and Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animated Counter Function
            function animateCounter(element, target, duration = 2000) {
                let start = 0;
                let increment = target / (duration / 16);
                let timer = setInterval(() => {
                    start += increment;
                    if (start >= target) {
                        element.textContent = target;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.ceil(start);
                    }
                }, 16);
            }

            // Initialize counters with staggered delays
            const counters = document.querySelectorAll('.counter');
            const statsCounters = document.querySelectorAll('.counter-stat');

            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const target = parseInt(element.getAttribute('data-target'));

                        // Stagger the animation start
                        setTimeout(() => {
                            animateCounter(element, target, 2000 + (index * 200));
                            element.classList.add('animate-pulse');

                            // Add completion effect
                            setTimeout(() => {
                                element.classList.remove('animate-pulse');
                                element.classList.add('animate-bounce');
                                setTimeout(() => {
                                    element.classList.remove(
                                        'animate-bounce');
                                }, 600);
                            }, 2200 + (index * 200));
                        }, index * 300);

                        observer.unobserve(element);
                    }
                });
            }, observerOptions);

            // Observe all counters
            [...counters, ...statsCounters].forEach(counter => {
                observer.observe(counter);
            });

            // Enhanced hover effects for cards
            const cards = document.querySelectorAll('.group');
            cards.forEach((card, index) => {
                card.addEventListener('mouseenter', function() {
                    // Add ripple effect
                    const ripple = document.createElement('div');
                    ripple.classList.add('absolute', 'inset-0', 'bg-gradient-to-r', 'from-white/10',
                        'to-transparent', 'opacity-0', 'pointer-events-none');
                    ripple.style.transform = 'scale(0)';
                    ripple.style.transition = 'all 0.6s ease';

                    this.appendChild(ripple);

                    requestAnimationFrame(() => {
                        ripple.style.opacity = '1';
                        ripple.style.transform = 'scale(1)';
                    });

                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.parentNode.removeChild(ripple);
                        }
                    }, 600);
                });
            });

            // Parallax effect for floating elements
            let mouseX = 0,
                mouseY = 0;

            document.addEventListener('mousemove', (e) => {
                mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
                mouseY = (e.clientY / window.innerHeight - 0.5) * 2;

                const floatingElements = document.querySelectorAll('.animate-float, .animate-bounce-slow');
                floatingElements.forEach((element, index) => {
                    const speed = (index + 1) * 0.02;
                    const x = mouseX * speed * 20;
                    const y = mouseY * speed * 20;
                    element.style.transform += ` translate(${x}px, ${y}px)`;
                });
            });

            // Progress bar animations
            const progressBars = document.querySelectorAll(
                '.animate-progress-fill, .animate-progress-fill-reverse, .animate-slide-right');
            const progressObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                        progressObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            progressBars.forEach(bar => {
                bar.style.animationPlayState = 'paused';
                progressObserver.observe(bar);
            });

            // Smooth scroll reveal animations
            const revealElements = document.querySelectorAll('.group, .bg-white, .bg-gradient-to-br');
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0px)';
                        }, index * 100);
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            });

            revealElements.forEach(element => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(30px)';
                element.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                revealObserver.observe(element);
            });

            // Enhanced button interactions
            const buttons = document.querySelectorAll('button, a[href]');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    // Create ripple effect
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    const ripple = document.createElement('span');
                    ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.6);
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        transform: scale(0);
                        animation: ripple 0.6s ease-out;
                        pointer-events: none;
                    `;

                    // Add ripple keyframe if not exists
                    if (!document.querySelector('#ripple-style')) {
                        const style = document.createElement('style');
                        style.id = 'ripple-style';
                        style.textContent = `
                            @keyframes ripple {
                                to { transform: scale(2); opacity: 0; }
                            }
                        `;
                        document.head.appendChild(style);
                    }

                    const rippleContainer = this.querySelector('.relative') || this;
                    if (getComputedStyle(rippleContainer).position === 'static') {
                        rippleContainer.style.position = 'relative';
                    }
                    rippleContainer.style.overflow = 'hidden';

                    rippleContainer.appendChild(ripple);

                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.parentNode.removeChild(ripple);
                        }
                    }, 600);
                });
            });

            // Dynamic theme adjustments based on time
            const hour = new Date().getHours();
            const body = document.body;

            if (hour >= 6 && hour < 12) {
                // Morning theme
                body.style.filter = 'brightness(1.1) saturate(1.1)';
            } else if (hour >= 12 && hour < 18) {
                // Afternoon theme
                body.style.filter = 'brightness(1) saturate(1.2)';
            } else {
                // Evening theme
                body.style.filter = 'brightness(0.95) saturate(0.9) hue-rotate(10deg)';
            }

            // Performance optimization: Reduce animations on low-end devices
            if (navigator.hardwareConcurrency && navigator.hardwareConcurrency < 4) {
                document.querySelectorAll('[class*="animate-"]').forEach(element => {
                    element.style.animationDuration = '0.5s';
                });
            }

            console.log('🎉 User Management Dashboard loaded with spectacular animations!');
        });

        // Add loading states for better perceived performance
        window.addEventListener('beforeunload', function() {
            document.body.style.opacity = '0.8';
            document.body.style.filter = 'blur(2px)';
        });
    </script>
</x-layouts.dashboard>
