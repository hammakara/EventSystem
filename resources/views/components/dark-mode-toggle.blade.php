@props(['class' => ''])

<button 
    {{ $attributes->merge(['class' => 'relative inline-flex items-center justify-center p-2 rounded-xl bg-white/80 dark:bg-neutral-800/80 backdrop-blur-sm border border-neutral-200/50 dark:border-neutral-700/50 shadow-sm hover:shadow-md transition-all duration-300 group ' . $class]) }}
    x-data="{ 
        darkMode: false,
        init() {
            this.darkMode = localStorage.getItem('darkMode') === 'true' || 
                           (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches);
            this.updateTheme();
        },
        toggle() {
            this.darkMode = !this.darkMode;
            this.updateTheme();
            localStorage.setItem('darkMode', this.darkMode);
        },
        updateTheme() {
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }"
    x-init="init()"
    @click="toggle()"
    :class="{ 'hover:scale-105': true }"
    title="Toggle dark mode">
    
    <!-- Sun Icon (Light Mode) -->
    <svg x-show="!darkMode" 
         x-transition:enter="transition ease-out duration-300 delay-100"
         x-transition:enter-start="opacity-0 scale-75 rotate-90"
         x-transition:enter-end="opacity-100 scale-100 rotate-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 rotate-0"
         x-transition:leave-end="opacity-0 scale-75 -rotate-90"
         class="w-5 h-5 text-amber-500 group-hover:text-amber-600 transition-colors duration-200" 
         fill="currentColor" 
         viewBox="0 0 24 24">
        <path d="M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zM2 13h2c.55 0 1-.45 1-1s-.45-1-1-1H2c-.55 0-1 .45-1 1s.45 1 1 1zm18 0h2c.55 0 1-.45 1-1s-.45-1-1-1h-2c-.55 0-1 .45-1 1s.45 1 1 1zM11 2v2c0 .55.45 1 1 1s1-.45 1-1V2c0-.55-.45-1-1-1s-1 .45-1 1zm0 18v2c0 .55.45 1 1 1s1-.45 1-1v-2c0-.55-.45-1-1-1s-1 .45-1 1zM5.99 4.58c-.39-.39-1.03-.39-1.41 0-.39.39-.39 1.03 0 1.41l1.06 1.06c.39.39 1.03.39 1.41 0s.39-1.03 0-1.41L5.99 4.58zm12.37 12.37c-.39-.39-1.03-.39-1.41 0-.39.39-.39 1.03 0 1.41l1.06 1.06c.39.39 1.03.39 1.41 0 .39-.39.39-1.03 0-1.41l-1.06-1.06zm1.06-10.96c.39-.39.39-1.03 0-1.41-.39-.39-1.03-.39-1.41 0l-1.06 1.06c-.39.39-.39 1.03 0 1.41s1.03.39 1.41 0l1.06-1.06zM7.05 18.36c.39-.39.39-1.03 0-1.41-.39-.39-1.03-.39-1.41 0l-1.06 1.06c-.39.39-.39 1.03 0 1.41s1.03.39 1.41 0l1.06-1.06z"/>
    </svg>
    
    <!-- Moon Icon (Dark Mode) -->
    <svg x-show="darkMode" 
         x-transition:enter="transition ease-out duration-300 delay-100"
         x-transition:enter-start="opacity-0 scale-75 -rotate-90"
         x-transition:enter-end="opacity-100 scale-100 rotate-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 rotate-0"
         x-transition:leave-end="opacity-0 scale-75 rotate-90"
         class="w-5 h-5 text-indigo-400 group-hover:text-indigo-300 transition-colors duration-200" 
         fill="currentColor" 
         viewBox="0 0 24 24">
        <path d="M12.34 2.02C6.59 1.82 2 6.42 2 12.25c0 5.52 4.48 10 10 10 3.71 0 6.93-2.02 8.66-5.02-7.51-.25-12.09-8.43-8.32-15.21z"/>
    </svg>
    
    <!-- Ripple effect -->
    <div class="absolute inset-0 rounded-xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-amber-400/20 to-indigo-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>
    </div>
</button>
