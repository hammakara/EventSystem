@props(['items' => [], 'adminItems' => []])
<aside class="md:hidden fixed inset-y-0 left-0 w-80 max-w-sm z-50 transform bg-white/95 backdrop-blur-sm border-r border-violet-100 dark:bg-neutral-900/95 dark:border-neutral-800 shadow-2xl"
       x-show="sidebarMobileOpen" 
       x-transition:enter="transition ease-out duration-300" 
       x-transition:enter-start="-translate-x-full" 
       x-transition:enter-end="translate-x-0" 
       x-transition:leave="transition ease-in duration-250" 
       x-transition:leave-start="translate-x-0" 
       x-transition:leave-end="-translate-x-full"
       x-trap.noscroll="sidebarMobileOpen">
    <div class="flex items-center h-16 px-4 gap-2 border-b border-violet-100 dark:border-neutral-800">
        <div class="w-9 h-9 rounded-xl bg-gradient-to-r from-fuchsia-500 to-indigo-500 flex items-center justify-center text-white font-bold">V</div>
        <span class="font-semibold">Ventixe</span>
        <button class="ml-auto rounded-xl border border-violet-100 dark:border-neutral-800 px-3 py-2" x-on:click="sidebarMobileOpen=false">Close</button>
    </div>
    <nav class="p-4 space-y-1 text-sm">
        <ul class="space-y-1">
            @foreach ($items as $item)
                <li>
                    <a href="{{ $item['href'] }}" class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all duration-200 {{ $item['active'] ? 'bg-gradient-to-r from-fuchsia-500/10 to-indigo-500/10 text-fuchsia-600 dark:text-fuchsia-400 font-medium' : 'hover:bg-violet-50 text-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800' }}">
                        <x-dashboard.icon :name="$item['icon']" class="w-5 h-5" />
                        <span>{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        
        @if(count($adminItems) > 0)
            <div class="mt-6 pt-4 border-t border-red-200 dark:border-red-800">
                <h3 class="px-3 py-2 text-xs font-semibold text-red-600 dark:text-red-400 uppercase tracking-wider">Administration</h3>
                <ul class="space-y-1">
                    @foreach ($adminItems as $item)
                        <li>
                            <a href="{{ $item['href'] }}" class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all duration-200 {{ $item['active'] ? 'bg-gradient-to-r from-red-500/10 to-orange-500/10 text-red-600 dark:text-red-400 font-medium' : 'hover:bg-red-50 text-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800' }}">
                                <x-dashboard.icon :name="$item['icon']" class="w-5 h-5" />
                                <span>{{ $item['label'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </nav>
    <div class="p-4 border-t border-violet-100 dark:border-neutral-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 px-3 py-2 text-neutral-700 dark:text-neutral-300">
                <x-dashboard.icon name="arrow-left-on-rectangle" class="w-5 h-5" /> {{ __('Sign Out') }}
            </button>
        </form>
    </div>
</aside>

