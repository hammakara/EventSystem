@props(['value', 'required' => false, 'cute' => true])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-neutral-700 dark:text-neutral-300 mb-2 transition-colors duration-200']) }}
       x-data="{ wiggle: false }"
       @click="if ($cute) { wiggle = true; setTimeout(() => wiggle = false, 500) }"
       :class="{ 'wiggle-cute': wiggle && {{ $cute ? 'true' : 'false' }} }">
    
    <span class="inline-flex items-center gap-1">
        {{ $value ?? $slot }}
        
        @if($required)
            <span class="text-red-500 text-xs ml-1 animate-pulse">*</span>
        @endif
        
        @if($cute)
            <span class="text-fuchsia-400 opacity-0 transition-opacity duration-200 group-hover:opacity-100">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                </svg>
            </span>
        @endif
    </span>
</label>
