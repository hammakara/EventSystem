<x-guest-layout>
    <!-- Professional Welcome Header -->
    <div class="text-center mb-8"
         x-data="{ mounted: false }"
         x-init="setTimeout(() => mounted = true, 200)"
         :class="{
             'opacity-100 translate-y-0': mounted,
             'opacity-0 translate-y-4': !mounted
         }"
         class="transition-all duration-700">
        
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-violet-500 via-purple-500 to-indigo-500 text-white shadow-2xl shadow-violet-500/25 mb-6"
             x-data="{ rotate: false }"
             x-init="setInterval(() => { rotate = !rotate }, 3000)"
             :class="{ 'rotate-12 scale-110': rotate }"
             class="transition-transform duration-1000">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-black bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-2">
            Welcome back!
        </h1>
        <p class="text-slate-600 dark:text-slate-400 font-medium max-w-sm mx-auto leading-relaxed">
            Sign in to your account to access amazing events and manage your bookings
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-2xl" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}"
          x-data="{
              loading: false,
              formValid: false,
              email: '{{ old('email') }}',
              password: '',
              showPassword: false,
              
              validateForm() {
                  this.formValid = this.email.includes('@') && this.email.includes('.') && this.password.length >= 6;
              }
          }"
          x-init="$watch('email', () => validateForm()); $watch('password', () => validateForm())"
          @submit="loading = true"
          class="space-y-6">
        @csrf

        <!-- Email Field -->
        <div class="space-y-2">
            <div class="relative">
                <input id="email" 
                       type="email" 
                       name="email" 
                       x-model="email"
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="Email Address"
                       class="w-full pl-14 pr-6 py-4 text-slate-900 dark:text-slate-100 bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border-2 border-slate-200/50 dark:border-slate-700/50 rounded-2xl focus:outline-none focus:ring-4 focus:ring-violet-500/20 dark:focus:ring-violet-400/20 focus:border-violet-500 dark:focus:border-violet-400 transition-all duration-300 hover:border-slate-300/70 dark:hover:border-slate-600/70 hover:bg-white/80 dark:hover:bg-slate-800/80 shadow-sm hover:shadow-md focus:shadow-lg" />
                <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400 pointer-events-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="text-sm text-red-500 font-medium" />
        </div>

        <!-- Password Field -->
        <div class="space-y-2">
            <div class="relative">
                <input id="password" 
                       ::type="showPassword ? 'text' : 'password'"
                       name="password" 
                       x-model="password"
                       required 
                       autocomplete="current-password"
                       placeholder="Password"
                       class="w-full pl-14 pr-16 py-4 text-slate-900 dark:text-slate-100 bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border-2 border-slate-200/50 dark:border-slate-700/50 rounded-2xl focus:outline-none focus:ring-4 focus:ring-violet-500/20 dark:focus:ring-violet-400/20 focus:border-violet-500 dark:focus:border-violet-400 transition-all duration-300 hover:border-slate-300/70 dark:hover:border-slate-600/70 hover:bg-white/80 dark:hover:bg-slate-800/80 shadow-sm hover:shadow-md focus:shadow-lg" />
                
                <!-- Lock Icon -->
                <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400 pointer-events-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                
                <!-- Password Toggle -->
                <button type="button"
                        @click="showPassword = !showPassword"
                        class="absolute right-5 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-violet-500 transition-colors duration-200 z-30 p-2 rounded-lg hover:bg-violet-50 dark:hover:bg-violet-900/20"
                        :class="{ 'text-violet-500': showPassword }">
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 711.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="text-sm text-red-500 font-medium" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" 
                       class="w-4 h-4 text-violet-600 bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-600 rounded focus:ring-violet-500 dark:focus:ring-violet-400 focus:ring-2 transition-colors duration-200" 
                       name="remember">
                <span class="ml-3 text-sm font-medium text-slate-600 dark:text-slate-400 group-hover:text-violet-600 dark:group-hover:text-violet-400 transition-colors duration-200">Remember me</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-violet-600 hover:text-violet-800 dark:text-violet-400 dark:hover:text-violet-300 transition-colors duration-200 hover:underline" 
                   href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button type="submit"
                :disabled="loading || !formValid"
                :class="{ 
                    'opacity-50 cursor-not-allowed': loading || !formValid,
                    'hover:shadow-xl hover:scale-105': !loading && formValid
                }"
                class="w-full btn-modern py-4 text-lg font-semibold rounded-2xl transition-all duration-300 disabled:hover:scale-100 disabled:hover:shadow-none">
            
            <span x-show="!loading" class="flex items-center justify-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 713 3v1"></path>
                </svg>
                Sign In to EventSphere
            </span>
            
            <span x-show="loading" class="flex items-center justify-center gap-3">
                <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 714 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Signing you in...
            </span>
        </button>
        
        <!-- Sign Up Link -->
        <div class="text-center pt-6 border-t border-slate-200 dark:border-slate-700">
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Don't have an account?
                <a href="{{ route('register') }}" 
                   class="font-semibold text-violet-600 hover:text-violet-800 dark:text-violet-400 dark:hover:text-violet-300 transition-colors duration-200 inline-flex items-center gap-1 group ml-1">
                    Create one now
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
