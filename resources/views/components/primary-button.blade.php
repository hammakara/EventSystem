@props(['loading' => false, 'size' => 'default'])

@php
$sizeClasses = [
    'sm' => 'px-4 py-2 text-sm',
    'default' => 'px-6 py-3 text-sm',
    'lg' => 'px-8 py-4 text-base'
][$size];
@endphp

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'relative inline-flex items-center justify-center ' . $sizeClasses . ' rounded-2xl font-semibold text-white bg-gradient-to-r from-fuchsia-600 via-purple-600 to-indigo-600 dark:from-fuchsia-500 dark:via-purple-500 dark:to-indigo-500 shadow-lg hover:shadow-xl hover:shadow-fuchsia-500/25 dark:hover:shadow-fuchsia-400/20 focus:outline-none focus:ring-2 focus:ring-fuchsia-500/50 dark:focus:ring-fuchsia-400/50 focus:ring-offset-2 dark:focus:ring-offset-neutral-900 transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed overflow-hidden group']) }}
        x-data="{ 
            loading: {{ $loading ? 'true' : 'false' }},
            clicked: false,
            ripples: []
        }"
        @click="
            clicked = true;
            setTimeout(() => clicked = false, 200);
            // Create ripple effect
            const rect = $el.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = $event.clientX - rect.left - size / 2;
            const y = $event.clientY - rect.top - size / 2;
            ripples.push({ x, y, size, id: Date.now() });
            setTimeout(() => ripples.shift(), 600);
        "
        :disabled="loading"
        :class="{ 
            'hover-bounce': !loading,
            'cursor-wait': loading,
            'wiggle-cute': clicked
        }">
        
    <!-- Ripple effects -->
    <template x-for="ripple in ripples" :key="ripple.id">
        <span class="absolute bg-white/30 rounded-full pointer-events-none animate-ping"
              :style="`left: ${ripple.x}px; top: ${ripple.y}px; width: ${ripple.size}px; height: ${ripple.size}px;`"></span>
    </template>
    
    <!-- Shimmer effect -->
    <div class="absolute inset-0 -top-2 -bottom-2 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 group-hover:animate-[shimmer_1s_ease-in-out] opacity-0 group-hover:opacity-100 transition-opacity"></div>
    
    <!-- Loading spinner -->
    <div x-show="loading" 
         class="absolute inset-0 flex items-center justify-center"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100">
        <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
    
    <!-- Button content -->
    <span :class="{ 'opacity-0': loading, 'opacity-100': !loading }"
          class="relative z-10 transition-opacity duration-200 flex items-center gap-2">
        {{ $slot }}
    </span>
</button>

<style>
@keyframes shimmer {
    0% { transform: translateX(-100%) skewX(-12deg); }
    100% { transform: translateX(200%) skewX(-12deg); }
}
</style>
