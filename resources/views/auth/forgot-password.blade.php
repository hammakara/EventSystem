<x-guest-layout>
    <div class="text-center mb-8"
         x-data="{ show: false }"
         x-init="setTimeout(() => show = true, 200)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0">
        
        <div class="mb-6">
            <!-- Cute animated icon -->
            <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-r from-fuchsia-100 to-indigo-100 dark:from-fuchsia-900/20 dark:to-indigo-900/20 mb-4 animate__animated animate__bounceIn">
                <svg class="w-10 h-10 text-fuchsia-600 float-cute" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            
            <h1 class="text-2xl font-bold bg-gradient-to-r from-fuchsia-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent mb-3 animate__animated animate__fadeInDown animate__delay-1s">
                Forgot Password? 
                <span class="inline-block animate__animated animate__pulse animate__delay-2s animate__infinite">
                    🤔
                </span>
            </h1>
            
            <div class="max-w-sm mx-auto">
                <p class="text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed animate__animated animate__fadeIn animate__delay-1s">
                    No worries! Enter your email address and we'll send you a link to reset your password.
                </p>
            </div>
        </div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 animate__animated animate__fadeIn" :status="session('status')" />

    <form method="POST" 
          action="{{ route('password.email') }}" 
          class="space-y-6"
          x-data="{ 
              loading: false,
              showForm: false,
              email: '{{ old('email') }}',
              emailSent: {{ session('status') ? 'true' : 'false' }},
              showSuccess: false,
              
              get isValidEmail() {
                  return this.email.includes('@') && this.email.includes('.');
              }
          }"
          x-init="
              setTimeout(() => showForm = true, 600);
              if (emailSent) {
                  setTimeout(() => showSuccess = true, 800);
              }
          "
          @submit="loading = true">
        @csrf
        
        <!-- Success Animation -->
        <div x-show="showSuccess && emailSent"
             x-transition:enter="transition ease-out duration-600"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             class="text-center py-8 animate__animated animate__bounceIn">
             
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/20 mb-4">
                <svg class="w-8 h-8 text-green-600 dark:text-green-400 animate__animated animate__bounceIn animate__delay-1s" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h2 class="text-xl font-semibold text-green-600 dark:text-green-400 mb-2">
                Email Sent Successfully! 
                <span class="inline-block animate__animated animate__bounceIn animate__delay-2s">
                    ✨
                </span>
            </h2>
            <p class="text-sm text-neutral-600 dark:text-neutral-400">
                Check your inbox and click the reset link
            </p>
        </div>

        <!-- Email Form -->
        <div x-show="showForm && !emailSent"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
             
            <div class="space-y-6">
                <!-- Email Input -->
                <div class="relative">
                    <x-text-input 
                        id="email" 
                        type="email" 
                        name="email" 
                        x-model="email"
                        :value="old('email')" 
                        required 
                        autofocus
                        floating-label="Email Address"
                        :icon="'<svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207\"></path></svg>'" 
                        @keydown.enter="if (isValidEmail) $el.form.submit()" />
                        
                    <!-- Email validation indicator -->
                    <div x-show="email.length > 0" class="absolute -right-12 top-1/2 transform -translate-y-1/2">
                        <div x-show="isValidEmail" 
                             class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center animate__animated animate__bounceIn">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div x-show="!isValidEmail" 
                             class="w-6 h-6 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center animate__animated animate__shakeX">
                            <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <x-input-error :messages="$errors->get('email')" class="animate__animated animate__shakeX" />
                
                <!-- Send Button -->
                <x-primary-button 
                    class="w-full group"
                    x-bind:disabled="!isValidEmail || loading"
                    x-bind:class="{ 'opacity-50 cursor-not-allowed': !isValidEmail || loading }">
                    
                    <span x-show="!loading" class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        {{ __('Send Reset Link') }}
                    </span>
                    <span x-show="loading" class="flex items-center justify-center gap-2">
                        <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sending email...
                    </span>
                </x-primary-button>
            </div>
        </div>
        
        <!-- Back to Login Link -->
        <div x-show="showForm"
             x-transition:enter="transition ease-out duration-400 delay-300"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="text-center pt-4">
             
            <p class="text-sm text-neutral-600 dark:text-neutral-400">
                Remember your password? 
                <a href="{{ route('login') }}" 
                   class="font-semibold text-fuchsia-600 hover:text-fuchsia-800 dark:text-fuchsia-400 dark:hover:text-fuchsia-300 transition-colors duration-200 relative group inline-flex items-center gap-1">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Back to Login
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
