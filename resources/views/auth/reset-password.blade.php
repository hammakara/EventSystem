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
            <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/20 dark:to-emerald-900/20 mb-4 animate__animated animate__bounceIn">
                <svg class="w-10 h-10 text-green-600 float-cute" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            
            <h1 class="text-2xl font-bold bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 bg-clip-text text-transparent mb-3 animate__animated animate__fadeInDown animate__delay-1s">
                Reset Your Password 
                <span class="inline-block animate__animated animate__pulse animate__delay-2s animate__infinite">
                    🔐
                </span>
            </h1>
            
            <div class="max-w-sm mx-auto">
                <p class="text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed animate__animated animate__fadeIn animate__delay-1s">
                    Choose a strong new password for your account
                </p>
            </div>
        </div>
    </div>

    <form method="POST" 
          action="{{ route('password.store') }}" 
          class="space-y-6"
          x-data="{ 
              loading: false,
              showForm: false,
              formData: {
                  email: '{{ old('email', $request->email) }}',
                  password: '',
                  password_confirmation: ''
              },
              showPassword: false,
              showConfirmPassword: false,
              passwordStrength: 0,
              
              get isValidEmail() {
                  return this.formData.email.includes('@') && this.formData.email.includes('.');
              },
              
              get passwordsMatch() {
                  return this.formData.password === this.formData.password_confirmation && this.formData.password_confirmation.length > 0;
              },
              
              get canSubmit() {
                  return this.isValidEmail && this.formData.password.length >= 8 && this.passwordsMatch;
              },
              
              calculatePasswordStrength(password) {
                  let strength = 0;
                  if (password.length >= 8) strength += 25;
                  if (/[A-Z]/.test(password)) strength += 25;
                  if (/[0-9]/.test(password)) strength += 25;
                  if (/[^A-Za-z0-9]/.test(password)) strength += 25;
                  this.passwordStrength = strength;
              }
          }"
          x-init="
              setTimeout(() => showForm = true, 600);
              $watch('formData.password', value => calculatePasswordStrength(value));
          "
          @submit="loading = true">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div x-show="showForm"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
             
            <!-- Email Field -->
            <div class="mb-6">
                <x-text-input 
                    id="email" 
                    type="email" 
                    name="email" 
                    x-model="formData.email"
                    :value="old('email', $request->email)" 
                    required 
                    autofocus 
                    autocomplete="username"
                    readonly
                    floating-label="Email Address"
                    :icon="'<svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207\"></path></svg>'" 
                    class="bg-neutral-50 dark:bg-neutral-800" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 animate__animated animate__shakeX" />
            </div>

            <!-- Password Fields -->
            <div class="space-y-6">
                <!-- New Password -->
                <div class="relative">
                    <x-text-input 
                        id="password" 
                        ::type="showPassword ? 'text' : 'password'"
                        name="password" 
                        x-model="formData.password"
                        required 
                        autocomplete="new-password"
                        floating-label="New Password"
                        :icon="'<svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z\"></path></svg>'" />
                    
                    <!-- Password toggle button -->
                    <button type="button"
                            @click="showPassword = !showPassword"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-neutral-400 hover:text-fuchsia-500 transition-colors duration-200 z-20 p-1 rounded-lg hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20"
                            :class="{ 'text-fuchsia-500': showPassword }">
                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Password Strength Indicator -->
                <div x-show="formData.password.length > 0" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="space-y-2">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-neutral-500">Password Strength</span>
                        <span :class="{
                            'text-red-500': passwordStrength < 50,
                            'text-yellow-500': passwordStrength >= 50 && passwordStrength < 75,
                            'text-green-500': passwordStrength >= 75
                        }" x-text="passwordStrength < 50 ? 'Weak' : passwordStrength < 75 ? 'Good' : 'Strong'"></span>
                    </div>
                    <div class="w-full bg-neutral-200 dark:bg-neutral-700 rounded-full h-2 overflow-hidden">
                        <div class="h-2 rounded-full transition-all duration-500"
                             :class="{
                                 'bg-red-500': passwordStrength < 50,
                                 'bg-yellow-500': passwordStrength >= 50 && passwordStrength < 75,
                                 'bg-green-500': passwordStrength >= 75
                             }"
                             :style="`width: ${passwordStrength}%`">
                        </div>
                    </div>
                    
                    <!-- Password Requirements -->
                    <div class="grid grid-cols-2 gap-2 text-xs mt-3">
                        <div class="flex items-center gap-2"
                             :class="{ 'text-green-600 dark:text-green-400': formData.password.length >= 8, 'text-neutral-500': formData.password.length < 8 }">
                            <svg class="w-3 h-3" :class="{ 'animate__animated animate__bounceIn': formData.password.length >= 8 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            8+ characters
                        </div>
                        <div class="flex items-center gap-2"
                             :class="{ 'text-green-600 dark:text-green-400': /[A-Z]/.test(formData.password), 'text-neutral-500': !/[A-Z]/.test(formData.password) }">
                            <svg class="w-3 h-3" :class="{ 'animate__animated animate__bounceIn': /[A-Z]/.test(formData.password) }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Uppercase
                        </div>
                        <div class="flex items-center gap-2"
                             :class="{ 'text-green-600 dark:text-green-400': /[0-9]/.test(formData.password), 'text-neutral-500': !/[0-9]/.test(formData.password) }">
                            <svg class="w-3 h-3" :class="{ 'animate__animated animate__bounceIn': /[0-9]/.test(formData.password) }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Number
                        </div>
                        <div class="flex items-center gap-2"
                             :class="{ 'text-green-600 dark:text-green-400': /[^A-Za-z0-9]/.test(formData.password), 'text-neutral-500': !/[^A-Za-z0-9]/.test(formData.password) }">
                            <svg class="w-3 h-3" :class="{ 'animate__animated animate__bounceIn': /[^A-Za-z0-9]/.test(formData.password) }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Special char
                        </div>
                    </div>
                </div>
                
                <x-input-error :messages="$errors->get('password')" class="animate__animated animate__shakeX" />
                
                <!-- Confirm Password -->
                <div class="relative">
                    <x-text-input 
                        id="password_confirmation" 
                        ::type="showConfirmPassword ? 'text' : 'password'"
                        name="password_confirmation" 
                        x-model="formData.password_confirmation"
                        required 
                        autocomplete="new-password"
                        floating-label="Confirm New Password"
                        :icon="'<svg class=\"w-5 h-5\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z\"></path></svg>'" />
                    
                    <button type="button"
                            @click="showConfirmPassword = !showConfirmPassword"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-neutral-400 hover:text-fuchsia-500 transition-colors duration-200 z-20 p-1 rounded-lg hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20"
                            :class="{ 'text-fuchsia-500': showConfirmPassword }">
                        <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    </button>
                    
                    <!-- Password Match Indicator -->
                    <div x-show="formData.password_confirmation.length > 0" class="absolute -right-12 top-1/2 transform -translate-y-1/2">
                        <div x-show="passwordsMatch" 
                             class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center animate__animated animate__bounceIn">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div x-show="!passwordsMatch" 
                             class="w-6 h-6 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center animate__animated animate__shakeX">
                            <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <x-input-error :messages="$errors->get('password_confirmation')" class="animate__animated animate__shakeX" />
            </div>

            <!-- Reset Button -->
            <div class="pt-4">
                <x-primary-button 
                    class="w-full group"
                    x-bind:disabled="!canSubmit || loading"
                    x-bind:class="{ 'opacity-50 cursor-not-allowed': !canSubmit || loading }">
                    
                    <span x-show="!loading" class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        {{ __('Reset Password') }}
                    </span>
                    <span x-show="loading" class="flex items-center justify-center gap-2">
                        <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Resetting password...
                    </span>
                </x-primary-button>
            </div>
            
            <!-- Back to Login Link -->
            <div class="text-center pt-4">
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
        </div>
    </form>
</x-guest-layout>
