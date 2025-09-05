@props(['title','value','sub' => null,'icon' => null,'accent' => 'from-fuchsia-500 to-indigo-500'])
<div class="group relative overflow-hidden rounded-3xl bg-white/70 backdrop-blur-md border border-white/40 p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 hover:scale-105 hover:-translate-y-1 dark:bg-neutral-900/60 dark:border-neutral-700/40 cursor-pointer">
    <!-- Animated background blobs -->
    <div class="absolute -top-12 -right-12 w-32 h-32 rounded-full bg-gradient-to-br {{ $accent }} opacity-20 blur-3xl group-hover:scale-150 group-hover:opacity-30 transition-all duration-700"></div>
    <div class="absolute -bottom-6 -left-6 w-20 h-20 rounded-full bg-gradient-to-tr {{ $accent }} opacity-10 blur-2xl group-hover:scale-125 group-hover:opacity-20 transition-all duration-500 animate-pulse-slow"></div>
    
    <!-- Sparkle decoration -->
    <div class="absolute top-4 right-4 text-white/20 group-hover:text-white/40 transition-all duration-300">
        <svg class="w-4 h-4 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2l2.4 7.2h7.6l-6 4.8 2.4 7.2-6-4.8-6 4.8 2.4-7.2-6-4.8h7.6z"/>
        </svg>
    </div>
    
    <!-- Content -->
    <div class="relative z-10">
        <!-- Icon -->
        <div class="w-14 h-14 mb-4 rounded-2xl bg-gradient-to-br {{ $accent }} flex items-center justify-center text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 animate-float">
            @if($icon)
                <div class="text-lg">
                    {!! $icon !!}
                </div>
            @else
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            @endif
        </div>
        
        <!-- Title -->
        <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400 mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-300">{{ $title }}</p>
        
        <!-- Value with animation -->
        <div class="flex items-baseline gap-2 mb-2">
            <p class="text-3xl font-bold bg-gradient-to-r from-neutral-800 to-neutral-600 dark:from-neutral-100 dark:to-neutral-300 bg-clip-text text-transparent group-hover:from-purple-600 group-hover:to-pink-600 transition-all duration-300" 
               x-data="{ displayValue: 0 }"
               x-init="() => {
                   const target = {{ $value }};
                   const duration = 2000;
                   const step = target / (duration / 16);
                   const timer = setInterval(() => {
                       displayValue += step;
                       if (displayValue >= target) {
                           displayValue = target;
                           clearInterval(timer);
                       }
                   }, 16);
               }"
               x-text="Math.floor(displayValue)">{{ $value }}</p>
            <div class="w-2 h-2 rounded-full bg-gradient-to-r {{ $accent }} animate-pulse"></div>
        </div>
        
        <!-- Subtitle -->
        @if($sub)
            <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium bg-emerald-50/50 dark:bg-emerald-900/20 px-2 py-1 rounded-full inline-block group-hover:bg-emerald-100/80 dark:group-hover:bg-emerald-900/40 transition-colors duration-300">{{ $sub }}</p>
        @endif
        
        <!-- Cute decorative line -->
        <div class="mt-4 h-1 w-full bg-gradient-to-r {{ $accent }} rounded-full opacity-30 group-hover:opacity-60 transition-opacity duration-300"></div>
    </div>
</div>

