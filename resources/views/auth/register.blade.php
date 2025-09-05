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
        
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-indigo-500 via-purple-500 to-violet-500 text-white shadow-2xl shadow-purple-500/25 mb-6"
             x-data="{ pulse: false }"
             x-init="setInterval(() => { pulse = !pulse }, 2000)"
             :class="{ 'scale-110 shadow-purple-500/40': pulse }"
             class="transition-all duration-1000">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-violet-600 bg-clip-text text-transparent mb-3">
            Join EventSphere
        </h1>
        <p class="text-slate-600 dark:text-slate-400 font-medium max-w-md mx-auto leading-relaxed">
            Create your account in just a few steps and discover amazing events worldwide
        </p>
    </div>

    <form method="POST" 
          action="{{ route('register') }}" 
          class="space-y-6"
          x-data="{ 
              loading: false,
              showForm: false,
              currentStep: 1,
              maxSteps: 3,
              formData: {
                  name: '{{ old('name') }}',
                  email: '{{ old('email') }}',
                  password: '',
                  password_confirmation: ''
              },
              showPassword: false,
              showConfirmPassword: false,
              passwordStrength: 0,
              
              get canProceed() {
                  if (this.currentStep === 1) {
                      return this.formData.name.length >= 2;
                  }
                  if (this.currentStep === 2) {
                      return this.formData.email.includes('@') && this.formData.email.includes('.');
                  }
                  if (this.currentStep === 3) {
                      return this.formData.password.length >= 8 && this.formData.password === this.formData.password_confirmation;
                  }
                  return false;
              },
              
              get progressPercent() {
                  return Math.round((this.currentStep / this.maxSteps) * 100);
              },
              
              calculatePasswordStrength(password) {
                  let strength = 0;
                  if (password.length >= 8) strength += 25;
                  if (/[A-Z]/.test(password)) strength += 25;
                  if (/[0-9]/.test(password)) strength += 25;
                  if (/[^A-Za-z0-9]/.test(password)) strength += 25;
                  this.passwordStrength = strength;
              },
              
              nextStep() {
                  if (this.canProceed && this.currentStep < this.maxSteps) {
                      this.currentStep++;
                  }
              },
              
              prevStep() {
                  if (this.currentStep > 1) {
                      this.currentStep--;
                  }
              }
          }"
          x-init="
              setTimeout(() => showForm = true, 400);
              $watch('formData.password', value => calculatePasswordStrength(value));
          "
          @submit="loading = true">
        @csrf
        
        <!-- Modern Progress Indicator -->
        <div x-show="showForm"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="mb-8">
            
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">Step <span x-text="currentStep"></span> of <span x-text="maxSteps"></span></span>
                <span class="text-sm font-bold text-violet-600 dark:text-violet-400" x-text="Math.round(progressPercent) + '%'"></span>
            </div>
            
            <!-- Step indicators -->
            <div class="flex items-center justify-between mb-6">
                <template x-for="step in maxSteps" :key="step">
                    <div class="flex items-center"
                         :class="step < maxSteps ? 'flex-1' : ''">
                        <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center font-semibold text-sm transition-all duration-300"
                             :class="{
                                 'bg-violet-600 border-violet-600 text-white shadow-lg shadow-violet-500/25': step <= currentStep,
                                 'border-slate-300 dark:border-slate-600 text-slate-400 dark:text-slate-500': step > currentStep
                             }">
                            <span x-text="step"></span>
                        </div>
                        <div x-show="step < maxSteps" class="flex-1 h-0.5 mx-4 transition-colors duration-300"
                             :class="{
                                 'bg-violet-600': step < currentStep,
                                 'bg-slate-200 dark:bg-slate-700': step >= currentStep
                             }"></div>
                    </div>
                </template>
            </div>
            
            <!-- Progress bar -->
            <div class="progress-modern">
                <div class="progress-fill" :style="`width: ${progressPercent}%`"></div>
            </div>
        </div>

        <!-- Step 1: Name -->
        <div x-show="showForm && currentStep === 1"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 -translate-x-8">
             
            <div class="space-y-4">
                <div class="text-center mb-6">
                    <h2 class="text-xl font-semibold text-neutral-800 dark:text-neutral-200 mb-2">What's your name?</h2>
                    <p class="text-sm text-neutral-500">Tell us how we should address you</p>
                </div>
                
                <div class="relative">
                    <input id="name" 
                           type="text" 
                           name="name" 
                           x-model="formData.name"
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name"
                           placeholder="Full Name"
                           @keydown.enter="nextStep()"
                           class="w-full pl-14 pr-6 py-4 text-slate-900 dark:text-slate-100 bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border-2 border-slate-200/50 dark:border-slate-700/50 rounded-2xl focus:outline-none focus:ring-4 focus:ring-violet-500/20 dark:focus:ring-violet-400/20 focus:border-violet-500 dark:focus:border-violet-400 transition-all duration-300 hover:border-slate-300/70 dark:hover:border-slate-600/70 hover:bg-white/80 dark:hover:bg-slate-800/80 shadow-sm hover:shadow-md focus:shadow-lg" />
                    <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2 animate__animated animate__shakeX" />
                
                <div class="flex justify-end mt-8">
                    <button type="button" 
                            @click="nextStep()"
                            :disabled="!canProceed"
                            :class="{ 'opacity-50 cursor-not-allowed': !canProceed }"
                            class="btn-modern py-3 px-8 rounded-2xl font-semibold transition-all duration-300 flex items-center gap-3 disabled:hover:scale-100">
                        Continue
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 2: Email -->
        <div x-show="showForm && currentStep === 2"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 -translate-x-8">
             
            <div class="space-y-4">
                <div class="text-center mb-6">
                    <h2 class="text-xl font-semibold text-neutral-800 dark:text-neutral-200 mb-2">What's your email?</h2>
                    <p class="text-sm text-neutral-500">We'll use this to send you event updates</p>
                </div>
                
                <div class="relative">
                    <input id="email" 
                           type="email" 
                           name="email" 
                           x-model="formData.email"
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username"
                           placeholder="Email Address"
                           @keydown.enter="nextStep()"
                           class="w-full pl-14 pr-6 py-4 text-slate-900 dark:text-slate-100 bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border-2 border-slate-200/50 dark:border-slate-700/50 rounded-2xl focus:outline-none focus:ring-4 focus:ring-violet-500/20 dark:focus:ring-violet-400/20 focus:border-violet-500 dark:focus:border-violet-400 transition-all duration-300 hover:border-slate-300/70 dark:hover:border-slate-600/70 hover:bg-white/80 dark:hover:bg-slate-800/80 shadow-sm hover:shadow-md focus:shadow-lg" />
                    <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 animate__animated animate__shakeX" />
                
                <div class="flex justify-between mt-8">
                    <button type="button" 
                            @click="prevStep()"
                            class="px-8 py-3 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-2xl font-semibold hover:bg-slate-300 dark:hover:bg-slate-600 transition-all duration-300 flex items-center gap-3 hover-lift-subtle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                        </svg>
                        Back
                    </button>
                    <button type="button" 
                            @click="nextStep()"
                            :disabled="!canProceed"
                            :class="{ 'opacity-50 cursor-not-allowed': !canProceed }"
                            class="btn-modern py-3 px-8 rounded-2xl font-semibold transition-all duration-300 flex items-center gap-3 disabled:hover:scale-100">
                        Continue
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Step 3: Password -->
        <div x-show="showForm && currentStep === 3"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 -translate-x-8">
             
            <div class="space-y-6">
                <div class="text-center mb-6">
                    <h2 class="text-xl font-semibold text-neutral-800 dark:text-neutral-200 mb-2">Secure your account</h2>
                    <p class="text-sm text-neutral-500">Create a strong password to protect your account</p>
                </div>
                
                <!-- Password Field -->
                <div class="relative">
                    <input id="password" 
                           :type="showPassword ? 'text' : 'password'"
                           name="password" 
                           x-model="formData.password"
                           required 
                           autocomplete="new-password"
                           placeholder="Password"
                           class="w-full pl-14 pr-16 py-4 text-slate-900 dark:text-slate-100 bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border-2 border-slate-200/50 dark:border-slate-700/50 rounded-2xl focus:outline-none focus:ring-4 focus:ring-violet-500/20 dark:focus:ring-violet-400/20 focus:border-violet-500 dark:focus:border-violet-400 transition-all duration-300 hover:border-slate-300/70 dark:hover:border-slate-600/70 hover:bg-white/80 dark:hover:bg-slate-800/80 shadow-sm hover:shadow-md focus:shadow-lg" />
                    <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <button type="button"
                            @click="showPassword = !showPassword"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-violet-500 transition-colors duration-200 z-20 p-1 rounded-lg hover:bg-violet-50 dark:hover:bg-violet-900/20"
                            :class="{ 'text-violet-500': showPassword }">
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
                <div x-show="formData.password.length > 0" class="space-y-2">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-neutral-500">Password Strength</span>
                        <span :class="{
                            'text-red-500': passwordStrength < 50,
                            'text-yellow-500': passwordStrength >= 50 && passwordStrength < 75,
                            'text-green-500': passwordStrength >= 75
                        }" x-text="passwordStrength < 50 ? 'Weak' : passwordStrength < 75 ? 'Good' : 'Strong'"></span>
                    </div>
                    <div class="w-full bg-neutral-200 dark:bg-neutral-700 rounded-full h-1.5">
                        <div class="h-1.5 rounded-full transition-all duration-300"
                             :class="{
                                 'bg-red-500': passwordStrength < 50,
                                 'bg-yellow-500': passwordStrength >= 50 && passwordStrength < 75,
                                 'bg-green-500': passwordStrength >= 75
                             }"
                             :style="`width: ${passwordStrength}%`">
                        </div>
                    </div>
                </div>
                
                <x-input-error :messages="$errors->get('password')" class="animate__animated animate__shakeX" />
                
                <!-- Confirm Password Field -->
                <div class="relative">
                    <input id="password_confirmation" 
                           :type="showConfirmPassword ? 'text' : 'password'"
                           name="password_confirmation" 
                           x-model="formData.password_confirmation"
                           required 
                           autocomplete="new-password"
                           placeholder="Confirm Password"
                           class="w-full pl-14 pr-16 py-4 text-slate-900 dark:text-slate-100 bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border-2 border-slate-200/50 dark:border-slate-700/50 rounded-2xl focus:outline-none focus:ring-4 focus:ring-violet-500/20 dark:focus:ring-violet-400/20 focus:border-violet-500 dark:focus:border-violet-400 transition-all duration-300 hover:border-slate-300/70 dark:hover:border-slate-600/70 hover:bg-white/80 dark:hover:bg-slate-800/80 shadow-sm hover:shadow-md focus:shadow-lg" />
                    <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400 pointer-events-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <button type="button"
                            @click="showConfirmPassword = !showConfirmPassword"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-violet-500 transition-colors duration-200 z-20 p-1 rounded-lg hover:bg-violet-50 dark:hover:bg-violet-900/20"
                            :class="{ 'text-violet-500': showConfirmPassword }">
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
                        <div x-show="formData.password === formData.password_confirmation && formData.password_confirmation.length > 0" 
                             class="w-6 h-6 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div x-show="formData.password !== formData.password_confirmation && formData.password_confirmation.length > 0" 
                             class="w-6 h-6 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <x-input-error :messages="$errors->get('password_confirmation')" class="animate__animated animate__shakeX" />
                
                <!-- Action Buttons -->
                <div class="flex justify-between mt-10">
                    <button type="button" 
                            @click="prevStep()"
                            class="px-8 py-3 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-2xl font-semibold hover:bg-slate-300 dark:hover:bg-slate-600 transition-all duration-300 flex items-center gap-3 hover-lift-subtle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                        </svg>
                        Back
                    </button>
                    
                    <button type="submit"
                            :disabled="!canProceed || loading"
                            :class="{ 
                                'opacity-50 cursor-not-allowed': !canProceed || loading,
                                'hover:shadow-xl hover:scale-105': !loading && canProceed
                            }"
                            class="btn-modern py-3 px-8 rounded-2xl font-semibold transition-all duration-300 disabled:hover:scale-100 disabled:hover:shadow-none">
                        
                        <span x-show="!loading" class="flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Create Account
                        </span>
                        <span x-show="loading" class="flex items-center justify-center gap-3">
                            <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 818-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 714 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Creating account...
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sign In Link -->
        <div x-show="showForm && currentStep === 3"
             x-transition:enter="transition ease-out duration-500 delay-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="text-center pt-8 border-t border-slate-200 dark:border-slate-700 mt-8">
             
            <p class="text-sm text-slate-600 dark:text-slate-400">
                Already have an account?
                <a href="{{ route('login') }}" 
                   class="font-semibold text-violet-600 hover:text-violet-800 dark:text-violet-400 dark:hover:text-violet-300 transition-colors duration-200 inline-flex items-center gap-2 group ml-1">
                    Sign in now
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
