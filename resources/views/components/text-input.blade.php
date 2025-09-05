@props(['disabled' => false, 'icon' => null, 'floatingLabel' => null, 'floating_label' => null, 'type' => 'text'])

@php
// Handle both kebab-case and camelCase
$floatingLabel = $floatingLabel ?? $floating_label;
@endphp

@php
$classes = 'peer w-full px-6 py-4 text-slate-900 dark:text-slate-100 bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl border-2 border-slate-200/50 dark:border-slate-700/50 rounded-2xl placeholder-transparent focus:outline-none focus:ring-4 focus:ring-violet-500/20 dark:focus:ring-violet-400/20 focus:border-violet-500 dark:focus:border-violet-400 transition-all duration-300 hover:border-slate-300/70 dark:hover:border-slate-600/70 hover:bg-white/80 dark:hover:bg-slate-800/80 disabled:bg-slate-100/50 dark:disabled:bg-slate-800/50 disabled:cursor-not-allowed group-focus-within:border-violet-500 dark:group-focus-within:border-violet-400 shadow-sm hover:shadow-md focus:shadow-lg';
@endphp

<div class="relative group"
     x-data="{ 
         focused: false, 
         hasValue: false,
         showIcon: {{ $icon ? 'true' : 'false' }},
         showPassword: false
     }"
     x-init="hasValue = $refs.input.value.length > 0"
     @click="$refs.input.focus()">
     
    @if($icon)
        <div class="absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400 dark:text-slate-500 transition-all duration-300 z-10"
             :class="{ 
                 'text-violet-500 dark:text-violet-400 scale-110': focused,
                 'text-slate-500 dark:text-slate-400': !focused
             }">
            {!! $icon !!}
        </div>
    @endif
    
    <input x-ref="input"
           @disabled($disabled) 
           type="{{ $type }}"
           {{ $attributes->merge(['class' => ($icon ? 'pl-14 ' : '') . $classes]) }}
           @focus="focused = true; $dispatch('input-focus', { field: '{{ $attributes->get('name') }}' })"
           @blur="focused = false; hasValue = $event.target.value.length > 0; $dispatch('input-blur', { field: '{{ $attributes->get('name') }}' })"
           @input="hasValue = $event.target.value.length > 0"
           :class="{
               'border-violet-500 dark:border-violet-400 ring-4 ring-violet-500/20 dark:ring-violet-400/20 shadow-lg shadow-violet-500/10': focused,
               'pl-14': showIcon
           }"
           placeholder=" ">
    
    @if($floatingLabel)
        <label class="absolute left-5 top-4 text-slate-500 dark:text-slate-400 transition-all duration-300 cursor-text select-none font-medium"
               :class="{
                   'transform -translate-y-7 scale-75 text-violet-600 dark:text-violet-400 font-semibold bg-white dark:bg-slate-800 px-2 rounded-md': focused || hasValue,
                   'left-14': showIcon && !(focused || hasValue),
                   'left-5': !showIcon || (focused || hasValue)
               }"
               @click="$refs.input.focus()">
            {{ $floatingLabel }}
        </label>
    @endif
    
    <!-- Success/Error State Indicator -->
    <div class="absolute right-16 top-1/2 transform -translate-y-1/2 transition-all duration-300 z-10"
         x-show="focused && hasValue && !showIcon"
         x-transition:enter="transition ease-out duration-200 delay-100"
         x-transition:enter-start="opacity-0 scale-90 rotate-180"
         x-transition:enter-end="opacity-100 scale-100 rotate-0">
        <div class="w-2 h-2 bg-gradient-to-r from-violet-500 to-purple-500 rounded-full shadow-sm shadow-violet-500/50"></div>
    </div>
    
    <!-- Focus Ring Animation -->
    <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-violet-500/10 via-purple-500/10 to-indigo-500/10 opacity-0 transition-opacity duration-300 pointer-events-none"
         :class="{ 'opacity-100': focused }"></div>
</div>
