<x-layouts.dashboard title="Create New User">
    <!-- Advanced CSS Animations and Effects -->
    <style>
        /* Enhanced Keyframe Animations */
        @keyframes slideInUp {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        @keyframes slideInRight {
            0% { transform: translateX(30px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInLeft {
            0% { transform: translateX(-30px); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes fadeInScale {
            0% { transform: scale(0.95); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-10px) rotate(1deg); }
            50% { transform: translateY(-20px) rotate(0deg); }
            75% { transform: translateY(-10px) rotate(-1deg); }
        }

        @keyframes bounce-gentle {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        @keyframes gradient-x {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.3); }
            50% { box-shadow: 0 0 40px rgba(99, 102, 241, 0.6); }
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(1deg); }
            75% { transform: rotate(-1deg); }
        }

        @keyframes typewriter {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-cursor {
            0%, 50% { border-color: transparent; }
            51%, 100% { border-color: currentColor; }
        }

        /* Apply animations */
        .animate-slide-in-up { animation: slideInUp 0.6s ease-out forwards; }
        .animate-slide-in-right { animation: slideInRight 0.6s ease-out forwards; }
        .animate-slide-in-left { animation: slideInLeft 0.6s ease-out forwards; }
        .animate-fade-in-scale { animation: fadeInScale 0.6s ease-out forwards; }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-bounce-gentle { animation: bounce-gentle 2s ease-in-out infinite; }
        .animate-gradient-x {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient-x 3s ease infinite;
        }
        .animate-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        .animate-pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
        .animate-wiggle { animation: wiggle 1s ease-in-out infinite; }

        /* Form enhancements */
        .form-group {
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.6s ease-out forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .form-group:nth-child(6) { animation-delay: 0.6s; }

        /* Enhanced input focus effects */
        .enhanced-input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .enhanced-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Floating label effect */
        .floating-label {
            position: relative;
        }

        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            transform: translateY(-25px) scale(0.85);
            color: rgb(99, 102, 241);
        }

        .floating-label label {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 4px;
        }

        /* Stagger animations */
        .stagger-animation > * {
            animation-delay: calc(var(--stagger) * 150ms);
        }

        /* Success animation */
        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .success-animation {
            animation: successPulse 0.6s ease-in-out;
        }

        /* Hover lift effect */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.25);
        }
    </style>

    <!-- Ventixe Theme Background with Animated Elements -->
    <div class="min-h-screen relative overflow-hidden bg-gradient-to-br from-purple-50/30 via-pink-50/20 to-indigo-50/40 dark:from-slate-900 dark:via-purple-900/10 dark:to-pink-900/10">
        <!-- Animated Background Particles -->
        <div class="fixed inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-32 h-32 bg-gradient-to-r from-purple-400/15 to-pink-400/15 rounded-full blur-xl animate-float"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-gradient-to-r from-indigo-400/15 to-purple-400/15 rounded-full blur-xl animate-pulse" style="animation-delay: -1s;"></div>
            <div class="absolute bottom-40 left-1/4 w-40 h-40 bg-gradient-to-r from-pink-400/15 to-rose-400/15 rounded-full blur-2xl animate-bounce-gentle"></div>
            <div class="absolute bottom-20 right-1/3 w-28 h-28 bg-gradient-to-r from-violet-400/15 to-purple-400/15 rounded-full blur-xl animate-float" style="animation-delay: -2s;"></div>
            <div class="absolute top-1/2 left-1/2 w-36 h-36 bg-gradient-to-r from-fuchsia-400/10 to-violet-400/10 rounded-full blur-2xl animate-pulse" style="animation-delay: -3s;"></div>
        </div>

        <div class="relative px-6 py-8 max-w-4xl mx-auto">
            <!-- Spectacular Header Section -->
            <div class="mb-12 animate-fade-in-scale">
                <div class="group relative overflow-hidden bg-white/80 dark:bg-slate-800/80 backdrop-blur-2xl rounded-3xl border border-white/30 dark:border-slate-700/30 shadow-2xl shadow-slate-900/10">
                    <!-- Animated Border Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-r from-violet-500/30 via-purple-500/30 to-pink-500/30 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity duration-700"></div>

                    <div class="relative p-8">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                            <div class="space-y-6">
                                <!-- Animated Title Section -->
                                {{-- <div class="flex items-center gap-6">
                                    <div class="group/icon relative animate-bounce-gentle">
                                        <!-- Multi-layer Icon with Glow Effects -->
                                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-cyan-600 rounded-2xl blur-xl opacity-60 group-hover/icon:opacity-100 group-hover/icon:scale-110 transition-all duration-500 animate-pulse"></div>
                                        <div class="relative w-16 h-16 bg-gradient-to-br from-emerald-600 via-cyan-600 to-blue-600 rounded-2xl flex items-center justify-center shadow-2xl transform group-hover/icon:scale-105 group-hover/icon:rotate-6 transition-all duration-500">
                                            <svg class="w-8 h-8 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                            </svg>

                                            <!-- Sparkle Effects -->
                                            <div class="absolute -top-1 -right-1 w-3 h-3">
                                                <div class="absolute inset-0 bg-yellow-400 rounded-full animate-ping opacity-75"></div>
                                                <div class="absolute inset-0 bg-yellow-300 rounded-full animate-pulse"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <h1 class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-slate-800 via-emerald-600 to-cyan-600 dark:from-white dark:via-emerald-400 dark:to-cyan-400 bg-clip-text text-transparent animate-gradient-x">
                                            Create New User
                                        </h1>
                                        <p class="text-lg text-slate-600 dark:text-slate-400 font-medium">
                                            Add a new user to your system with complete account setup
                                        </p>

                                        <!-- Animated Progress Indicator -->
                                        <div class="flex items-center gap-4 mt-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse shadow-lg shadow-emerald-500/50"></div>
                                                <span class="text-sm text-emerald-600 dark:text-emerald-400 font-semibold">Step 1 of 1</span>
                                            </div>
                                            <div class="flex-1 max-w-xs">
                                                <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                                    <div class="h-full bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-full animate-shimmer" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- Enhanced Breadcrumb with Animations -->
                                <nav class="flex items-center gap-2 text-sm animate-slide-in-left">
                                    <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-2 px-4 py-2 text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-xl transition-all duration-300 hover:scale-105">
                                        <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z"/>
                                        </svg>
                                        <span class="font-medium">Dashboard</span>
                                    </a>
                                    <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    <a href="{{ route('users.index') }}" class="group flex items-center gap-2 px-4 py-2 text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-xl transition-all duration-300 hover:scale-105">
                                        <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                        </svg>
                                        <span class="font-medium">Users</span>
                                    </a>
                                    <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                   
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Spectacular Form Container -->
            <div class="group relative overflow-hidden bg-white/90 dark:bg-slate-800/90 backdrop-blur-2xl rounded-2xl border border-slate-200/50 dark:border-slate-700/30 shadow-2xl shadow-slate-900/5 animate-slide-in-up">
                <!-- Animated Background Elements -->
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 via-cyan-500/5 to-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-gradient-to-br from-emerald-400/10 to-cyan-400/10 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute -bottom-5 -left-5 w-32 h-32 bg-gradient-to-br from-cyan-400/10 to-blue-400/10 rounded-full blur-2xl animate-float"></div>

                <!-- Form Header -->
                <div class="relative p-8 border-b border-slate-200/50 dark:border-slate-700/30">
                    <div class="flex items-center gap-4">
                        <div class="relative animate-bounce-gentle">
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl blur-lg opacity-40 animate-pulse"></div>
                            <div class="relative w-12 h-12 bg-gradient-to-r from-emerald-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold bg-gradient-to-r from-slate-900 via-emerald-600 to-cyan-600 dark:from-white dark:via-emerald-400 dark:to-cyan-400 bg-clip-text text-transparent">User Information</h3>
                            <p class="text-slate-600 dark:text-slate-400 mt-1">Fill in the details below to create a new user account</p>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Form -->
                <div class="relative p-8">
                    <form method="POST" action="{{ route('users.store') }}" class="space-y-8" x-data="{
                        submitting: false,
                        formData: {
                            name: '',
                            email: '',
                            password: '',
                            password_confirmation: '',
                            roles: []
                        }
                    }">
                        @csrf

                        <!-- Personal Information Section -->
                        <div class="space-y-6">
                            <div class="flex items-center gap-3 mb-6 form-group">
                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 dark:text-white">Personal Information</h4>
                                <div class="flex-1 h-px bg-gradient-to-r from-indigo-500/30 to-transparent"></div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Name Field -->
                                <div class="form-group">
                                    <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                                        Full Name *
                                    </label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300 group-focus-within:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               value="{{ old('name') }}"
                                               x-model="formData.name"
                                               placeholder="Enter full name"
                                               required
                                               class="enhanced-input w-full pl-12 pr-4 py-4 bg-slate-50/80 dark:bg-slate-900/80 backdrop-blur-sm border-2 border-slate-300/50 dark:border-slate-600/50 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-300 placeholder-slate-400 text-slate-900 dark:text-white font-medium shadow-inner hover:shadow-lg">
                                        @error('name')
                                            <div class="absolute inset-0 rounded-xl border-2 border-red-500/50 pointer-events-none animate-wiggle"></div>
                                        @enderror
                                    </div>
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-2 animate-slide-in-right">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Email Field -->
                                <div class="form-group">
                                    <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                                        Email Address *
                                    </label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                            </svg>
                                        </div>
                                        <input type="email"
                                               name="email"
                                               id="email"
                                               value="{{ old('email') }}"
                                               x-model="formData.email"
                                               placeholder="Enter email address"
                                               required
                                               class="enhanced-input w-full pl-12 pr-4 py-4 bg-slate-50/80 dark:bg-slate-900/80 backdrop-blur-sm border-2 border-slate-300/50 dark:border-slate-600/50 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-300 placeholder-slate-400 text-slate-900 dark:text-white font-medium shadow-inner hover:shadow-lg">
                                        @error('email')
                                            <div class="absolute inset-0 rounded-xl border-2 border-red-500/50 pointer-events-none animate-wiggle"></div>
                                        @enderror
                                    </div>
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-2 animate-slide-in-right">
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
                            <div class="flex items-center gap-3 mb-6 form-group">
                                <div class="w-8 h-8 bg-gradient-to-r from-red-500 to-orange-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 dark:text-white">Security Information</h4>
                                <div class="flex-1 h-px bg-gradient-to-r from-red-500/30 to-transparent"></div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Password Field -->
                                <div class="form-group">
                                    <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                                        Password *
                                    </label>
                                    <div class="relative group" x-data="{ showPassword: false }">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                        </div>
                                        <input :type="showPassword ? 'text' : 'password'"
                                               name="password"
                                               id="password"
                                               x-model="formData.password"
                                               placeholder="Enter password"
                                               required
                                               class="enhanced-input w-full pl-12 pr-12 py-4 bg-slate-50/80 dark:bg-slate-900/80 backdrop-blur-sm border-2 border-slate-300/50 dark:border-slate-600/50 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-300 placeholder-slate-400 text-slate-900 dark:text-white font-medium shadow-inner hover:shadow-lg">
                                        <button type="button"
                                                @click="showPassword = !showPassword"
                                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-indigo-500 transition-colors duration-200">
                                            <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464M9.878 9.878l-4.242 4.242m0 0L3.222 16.535M14.12 14.12L17.657 17.657"/>
                                            </svg>
                                        </button>
                                        @error('password')
                                            <div class="absolute inset-0 rounded-xl border-2 border-red-500/50 pointer-events-none animate-wiggle"></div>
                                        @enderror
                                    </div>
                                    @error('password')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-2 animate-slide-in-right">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Password Confirmation Field -->
                                <div class="form-group">
                                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                                        Confirm Password *
                                    </label>
                                    <div class="relative group" x-data="{ showConfirmPassword: false }">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <input :type="showConfirmPassword ? 'text' : 'password'"
                                               name="password_confirmation"
                                               id="password_confirmation"
                                               x-model="formData.password_confirmation"
                                               placeholder="Confirm password"
                                               required
                                               class="enhanced-input w-full pl-12 pr-12 py-4 bg-slate-50/80 dark:bg-slate-900/80 backdrop-blur-sm border-2 border-slate-300/50 dark:border-slate-600/50 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-300 placeholder-slate-400 text-slate-900 dark:text-white font-medium shadow-inner hover:shadow-lg">
                                        <button type="button"
                                                @click="showConfirmPassword = !showConfirmPassword"
                                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-indigo-500 transition-colors duration-200">
                                            <svg x-show="!showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            <svg x-show="showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464M9.878 9.878l-4.242 4.242m0 0L3.222 16.535M14.12 14.12L17.657 17.657"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Roles Section -->
                        <div class="space-y-6">
                            <div class="flex items-center gap-3 mb-6 form-group">
                                <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 dark:text-white">Role Assignment</h4>
                                <div class="flex-1 h-px bg-gradient-to-r from-purple-500/30 to-transparent"></div>
                            </div>

                            <!-- Role Selection -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-4">
                                    Assign Roles *
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    @php
                                        $roles = \Spatie\Permission\Models\Role::all();
                                        $roleColors = [
                                            'admin' => 'from-red-500 to-red-600',
                                            'organizer' => 'from-blue-500 to-blue-600',
                                            'attendee' => 'from-green-500 to-green-600'
                                        ];
                                        $roleIcons = [
                                            'admin' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                                            'organizer' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                                            'attendee' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
                                        ];
                                    @endphp

                                    @foreach($roles as $role)
                                        <div class="group relative hover-lift">
                                            <input type="checkbox"
                                                   name="roles[]"
                                                   value="{{ $role->name }}"
                                                   id="role_{{ $role->name }}"
                                                   x-model="formData.roles"
                                                   {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}
                                                   class="peer sr-only">
                                            <label for="role_{{ $role->name }}"
                                                   class="flex flex-col items-center p-6 bg-slate-50/80 dark:bg-slate-900/80 backdrop-blur-sm border-2 border-slate-300/50 dark:border-slate-600/50 rounded-xl cursor-pointer transition-all duration-300 hover:border-indigo-400 hover:shadow-lg peer-checked:border-indigo-500 peer-checked:bg-gradient-to-br peer-checked:{{ $roleColors[$role->name] ?? 'from-indigo-500 to-purple-600' }} peer-checked:text-white peer-checked:shadow-xl peer-checked:shadow-indigo-500/30 group-hover:scale-105">

                                                <!-- Role Icon -->
                                                <div class="w-12 h-12 bg-gradient-to-br {{ $roleColors[$role->name] ?? 'from-indigo-500 to-purple-600' }} rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-300 peer-checked:bg-white/20">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $roleIcons[$role->name] ?? 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' }}"/>
                                                    </svg>
                                                </div>

                                                <!-- Role Name -->
                                                <span class="font-bold text-lg capitalize mb-2">{{ $role->name }}</span>

                                                <!-- Role Description -->
                                                <span class="text-xs text-center opacity-70 leading-relaxed">
                                                    @switch($role->name)
                                                        @case('admin')
                                                            Full system access and management
                                                            @break
                                                        @case('organizer')
                                                            Create and manage events
                                                            @break
                                                        @case('attendee')
                                                            Participate in events
                                                            @break
                                                        @default
                                                            {{ ucfirst($role->name) }} privileges
                                                    @endswitch
                                                </span>

                                                <!-- Checkmark Animation -->
                                                <div class="absolute top-3 right-3 w-6 h-6 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-all duration-300 flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-green-600 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('roles')
                                    <p class="mt-3 text-sm text-red-600 dark:text-red-400 flex items-center gap-2 animate-slide-in-right">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Spectacular Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-slate-200/50 dark:border-slate-700/30 form-group">
                            <!-- Cancel Button -->
                            <a href="{{ route('users.index') }}"
                               class="group relative flex-1 sm:flex-none px-8 py-4 bg-slate-200/80 hover:bg-slate-300/80 dark:bg-slate-700/80 dark:hover:bg-slate-600/80 text-slate-700 dark:text-slate-200 font-bold rounded-xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg backdrop-blur-sm border border-slate-300/50 dark:border-slate-600/50">
                                <div class="flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    <span class="text-lg font-bold">Cancel</span>
                                </div>
                            </a>

                            <!-- Submit Button -->
                            <button type="submit"
                                    :disabled="submitting"
                                    @click="submitting = true"
                                    class="group relative flex-1 px-8 py-4 bg-gradient-to-r from-emerald-600 via-cyan-600 to-blue-600 hover:from-emerald-700 hover:via-cyan-700 hover:to-blue-700 disabled:from-slate-400 disabled:to-slate-500 text-white font-bold rounded-xl shadow-2xl shadow-emerald-500/30 hover:shadow-emerald-500/50 disabled:shadow-none transition-all duration-500 transform hover:scale-105 hover:-translate-y-1 disabled:scale-100 disabled:translate-y-0">
                                <!-- Multiple Glow Layers -->
                                <div class="absolute -inset-1 bg-gradient-to-r from-emerald-600 via-cyan-600 to-blue-600 rounded-2xl blur-lg opacity-70 group-hover:opacity-100 group-disabled:opacity-0 transition-opacity duration-500 animate-pulse"></div>
                                <div class="absolute -inset-0.5 bg-gradient-to-r from-emerald-500 via-cyan-500 to-blue-500 rounded-2xl opacity-50 group-hover:opacity-100 group-disabled:opacity-0 transition-opacity duration-300"></div>

                                <div class="relative flex items-center justify-center gap-3">
                                    <!-- Animated Loading Spinner -->
                                    <svg x-show="submitting" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>

                                    <!-- Create Icon -->
                                    <svg x-show="!submitting" class="w-5 h-5 group-hover:rotate-180 transition-transform duration-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>

                                    <span class="text-lg font-bold tracking-wide" x-text="submitting ? 'Creating User...' : 'Create User'"></span>
                                </div>

                                <!-- Floating Sparkles -->
                                <div x-show="!submitting" class="absolute -top-2 -right-2 w-4 h-4">
                                    <div class="absolute inset-0 bg-yellow-400 rounded-full animate-ping opacity-75"></div>
                                    <div class="absolute inset-0 bg-yellow-300 rounded-full animate-pulse"></div>
                                </div>
                                <div x-show="!submitting" class="absolute -bottom-1 -left-1 w-3 h-3">
                                    <div class="absolute inset-0 bg-pink-400 rounded-full animate-bounce opacity-75"></div>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced JavaScript for Enhanced Animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced form validation animations
            const inputs = document.querySelectorAll('input[required]');
            const form = document.querySelector('form');

            // Real-time validation feedback
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    const group = this.closest('.form-group');
                    const errorMsg = group.querySelector('.text-red-600');

                    if (this.validity.valid) {
                        this.classList.remove('border-red-500');
                        this.classList.add('border-green-500');

                        // Add success pulse
                        this.classList.add('animate-pulse');
                        setTimeout(() => {
                            this.classList.remove('animate-pulse');
                        }, 600);

                        if (errorMsg) {
                            errorMsg.style.opacity = '0';
                            errorMsg.style.transform = 'translateX(-20px)';
                        }
                    } else {
                        this.classList.remove('border-green-500');
                        this.classList.add('border-red-500');
                    }
                });

                // Focus animations
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('animate-pulse-glow');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('animate-pulse-glow');
                });
            });

            // Password strength indicator
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    const strength = calculatePasswordStrength(password);
                    updatePasswordStrengthIndicator(this, strength);
                });
            }

            if (confirmPasswordInput) {
                confirmPasswordInput.addEventListener('input', function() {
                    const password = passwordInput.value;
                    const confirmPassword = this.value;

                    if (password && confirmPassword) {
                        if (password === confirmPassword) {
                            this.classList.remove('border-red-500');
                            this.classList.add('border-green-500');

                            // Add success animation
                            const icon = this.parentElement.querySelector('svg');
                            if (icon) {
                                icon.classList.add('text-green-500', 'animate-bounce');
                                setTimeout(() => {
                                    icon.classList.remove('animate-bounce');
                                }, 600);
                            }
                        } else {
                            this.classList.remove('border-green-500');
                            this.classList.add('border-red-500');
                        }
                    }
                });
            }

            // Role selection animations
            const roleCheckboxes = document.querySelectorAll('input[name="roles[]"]');
            roleCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const label = document.querySelector(`label[for="${this.id}"]`);
                    if (this.checked) {
                        label.classList.add('success-animation');

                        // Create celebration effect
                        createCelebrationEffect(label);

                        setTimeout(() => {
                            label.classList.remove('success-animation');
                        }, 600);
                    }
                });
            });

            // Form submission animation
            form.addEventListener('submit', function() {
                const submitButton = this.querySelector('button[type="submit"]');

                // Add loading state
                submitButton.disabled = true;
                submitButton.classList.add('animate-pulse');

                // Create form submission effect
                this.style.opacity = '0.8';
                this.style.transform = 'scale(0.98)';
                this.style.filter = 'blur(1px)';
            });

            // Progressive form reveal
            const formGroups = document.querySelectorAll('.form-group');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            formGroups.forEach(group => {
                observer.observe(group);
            });

            // Dynamic theme adjustments
            const hour = new Date().getHours();
            const body = document.body;

            if (hour >= 6 && hour < 12) {
                body.style.filter = 'brightness(1.1) saturate(1.1)';
            } else if (hour >= 12 && hour < 18) {
                body.style.filter = 'brightness(1) saturate(1.2)';
            } else {
                body.style.filter = 'brightness(0.95) saturate(0.9) hue-rotate(5deg)';
            }

            console.log('🎉 User Creation Form loaded with spectacular animations!');
        });

        // Helper functions
        function calculatePasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            return strength;
        }

        function updatePasswordStrengthIndicator(input, strength) {
            // Remove existing strength classes
            input.classList.remove('border-red-500', 'border-yellow-500', 'border-green-500');

            if (strength <= 2) {
                input.classList.add('border-red-500');
            } else if (strength <= 3) {
                input.classList.add('border-yellow-500');
            } else {
                input.classList.add('border-green-500');
            }
        }

        function createCelebrationEffect(element) {
            const rect = element.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;

            // Create sparkle particles
            for (let i = 0; i < 6; i++) {
                const particle = document.createElement('div');
                particle.className = 'absolute w-2 h-2 bg-yellow-400 rounded-full pointer-events-none z-50';
                particle.style.left = centerX + 'px';
                particle.style.top = centerY + 'px';

                document.body.appendChild(particle);

                const angle = (Math.PI * 2 * i) / 6;
                const distance = 50;
                const x = Math.cos(angle) * distance;
                const y = Math.sin(angle) * distance;

                particle.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                particle.style.transform = `translate(${x}px, ${y}px) scale(0)`;
                particle.style.opacity = '0';

                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.parentNode.removeChild(particle);
                    }
                }, 800);
            }
        }
    </script>
</x-layouts.dashboard>
