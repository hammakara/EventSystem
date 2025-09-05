@props(['items' => [], 'adminItems' => []])
<aside class="hidden md:flex transition-all duration-300 ease-in-out will-change-[width]" role="navigation"
    aria-label="Sidebar" x-bind:class="sidebarCollapsed ? 'md:w-16 lg:w-20' : 'md:w-64 lg:w-72 xl:w-80'"
    x-bind:style="{ minWidth: sidebarCollapsed ? '4rem' : '16rem' }">
    <div
        class="flex flex-col h-screen sticky top-0 bg-white/70 backdrop-blur-md border-r border-white/20 dark:bg-neutral-900/70 dark:border-neutral-700/30 shadow-xl">
        <div class="flex items-center h-16 px-4 gap-3 border-b border-white/30 dark:border-neutral-700/30">
            <div
                class="w-10 h-10 rounded-2xl bg-gradient-to-br from-pink-400 via-purple-500 to-indigo-500 flex items-center justify-center text-white font-bold text-lg shadow-lg transform hover:scale-105 transition-all duration-200 animate-pulse-slow">
                V</div>
            <span class="font-bold text-lg bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent"
                x-show="!sidebarCollapsed" x-cloak>Ventixe</span>
        </div>

        <nav class="flex-1 overflow-y-auto p-3 space-y-1 text-sm">
            <div class="space-y-2">
                <p class="px-3 text-xs font-semibold text-neutral-500 uppercase tracking-wider"
                    x-show="!sidebarCollapsed" x-cloak>Main</p>
                <ul class="space-y-1">
                    @foreach ($items as $item)
                        <li class="relative">
                            <a href="{{ $item['href'] }}" aria-label="{{ $item['label'] }}"
                                class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-pink-400 hover:shadow-lg hover:scale-105 transform
                                      {{ $item['active'] ? 'bg-gradient-to-r from-pink-400/20 via-purple-400/20 to-indigo-400/20 text-purple-600 dark:text-purple-400 font-semibold shadow-md backdrop-blur-sm border border-white/30' : 'hover:bg-gradient-to-r hover:from-white/50 hover:to-purple-50/50 text-neutral-700 dark:text-neutral-300 hover:text-purple-600 dark:hover:bg-neutral-800/50' }}"
                                x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'"
                                @if ($item['active']) aria-current="page" @endif>
                                @if ($item['active'])
                                    <span aria-hidden="true"
                                        class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-pink-400 to-purple-500 shadow-sm"></span>
                                @endif
                                <x-dashboard.icon :name="$item['icon']"
                                    class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                    x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' :
                                        'group-hover:scale-110'" />
                                <span x-show="!sidebarCollapsed" x-cloak class="font-medium"
                                    x-transition:enter="transition ease-out duration-300 delay-100"
                                    x-transition:enter-start="opacity-0 translate-x-3"
                                    x-transition:enter-end="opacity-100 translate-x-0"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0">{{ $item['label'] }}</span>
                                <!-- Enhanced tooltip when collapsed -->
                                <div x-show="sidebarCollapsed" x-cloak
                                    class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                    <div
                                        class="whitespace-nowrap rounded-lg bg-neutral-900/95 dark:bg-neutral-800/95 text-white text-sm px-3 py-2 shadow-xl backdrop-blur-sm border border-neutral-700/50">
                                        {{ $item['label'] }}
                                        <div
                                            class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-neutral-900/95 dark:bg-neutral-800/95 rotate-45 border-l border-t border-neutral-700/50">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            @if(count($adminItems) > 0)
                <div class="space-y-2 pt-4 border-t border-neutral-200/50 dark:border-neutral-700/50 mt-4">
                    <p class="px-3 text-xs font-semibold text-red-500 dark:text-red-400 uppercase tracking-wider"
                        x-show="!sidebarCollapsed" x-cloak>Administration</p>
                    <ul class="space-y-1">
                        @foreach ($adminItems as $item)
                            <li class="relative">
                                <a href="{{ $item['href'] }}" aria-label="{{ $item['label'] }}"
                                    class="relative group flex items-center gap-3 rounded-2xl transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-400 hover:shadow-lg hover:scale-105 transform
                                          {{ $item['active'] ? 'bg-gradient-to-r from-red-400/20 via-orange-400/20 to-yellow-400/20 text-red-600 dark:text-red-400 font-semibold shadow-md backdrop-blur-sm border border-white/30' : 'hover:bg-gradient-to-r hover:from-white/50 hover:to-red-50/50 text-neutral-700 dark:text-neutral-300 hover:text-red-600 dark:hover:bg-neutral-800/50' }}"
                                    x-bind:class="sidebarCollapsed ? 'px-3 py-4 justify-center' : 'px-4 py-3'"
                                    @if ($item['active']) aria-current="page" @endif>
                                    @if ($item['active'])
                                        <span aria-hidden="true"
                                            class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1.5 rounded-r-full bg-gradient-to-b from-red-400 to-orange-500 shadow-sm"></span>
                                    @endif
                                    <x-dashboard.icon :name="$item['icon']"
                                        class="w-5 h-5 flex-shrink-0 transition-all duration-300"
                                        x-bind:class="sidebarCollapsed ? 'group-hover:scale-125 group-hover:rotate-12' :
                                            'group-hover:scale-110'" />
                                    <span x-show="!sidebarCollapsed" x-cloak class="font-medium"
                                        x-transition:enter="transition ease-out duration-300 delay-100"
                                        x-transition:enter-start="opacity-0 translate-x-3"
                                        x-transition:enter-end="opacity-100 translate-x-0"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0">{{ $item['label'] }}</span>
                                    <!-- Enhanced tooltip when collapsed -->
                                    <div x-show="sidebarCollapsed" x-cloak
                                        class="pointer-events-none absolute left-full top-1/2 -translate-y-1/2 ml-3 opacity-0 group-hover:opacity-100 transition-all duration-200 delay-300 z-50">
                                        <div
                                            class="whitespace-nowrap rounded-lg bg-neutral-900/95 dark:bg-neutral-800/95 text-white text-sm px-3 py-2 shadow-xl backdrop-blur-sm border border-neutral-700/50">
                                            {{ $item['label'] }}
                                            <div
                                                class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-1 w-2 h-2 bg-neutral-900/95 dark:bg-neutral-800/95 rotate-45 border-l border-t border-neutral-700/50">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </nav>

        <div class="mt-auto p-3">
            <div class="flex items-center justify-between gap-2">
                <!-- Collapse/expand -->
                <button
                    class="md:inline-flex items-center justify-center rounded-xl border border-violet-100 dark:border-neutral-800 bg-white dark:bg-neutral-900 text-neutral-700 dark:text-neutral-300 px-3 py-2"
                    x-on:click="toggleCollapse()" :title="sidebarCollapsed ? 'Expand' : 'Collapse'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path x-show="!sidebarCollapsed" x-cloak stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M4 12h16M10 6l-6 6 6 6" />
                        <path x-show="sidebarCollapsed" x-cloak stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M20 12H4m10 6l6-6-6-6" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</aside>
