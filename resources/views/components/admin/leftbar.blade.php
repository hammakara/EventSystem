<!-- Sidebar -->
<div id="hs-application-sidebar"
    class="hs-overlay  [--auto-close:lg]
  hs-overlay-open:translate-x-0
  -translate-x-full transition-all duration-300 transform
  w-65 h-full
  hidden
  fixed inset-y-0 start-0 z-60
  bg-white border-e border-gray-200
  lg:block lg:translate-x-0 lg:end-auto lg:bottom-0
  dark:bg-gray-800 dark:border-gray-700"
    role="dialog" tabindex="-1" aria-label="Sidebar">
    <div class="relative flex flex-col h-full max-h-full">
        <div class="px-6 pt-4 flex items-center">
            <!-- Logo Section Optimized for Event Management -->
            <a class="flex items-center gap-2 text-xl font-bold rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50 transition duration-150"
                href="#" aria-label="EventPro">

                <!-- Icon: Stylized Calendar with Checkmark (representing managed events/dates) -->
                <svg class="w-8 h-auto shrink-0 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <!-- Calendar frame -->
                    <rect x="5" y="6" width="22" height="22" rx="4" ry="4" stroke-width="2.5" />
                    <!-- Month strip divider -->
                    <line x1="5" y1="12" x2="27" y2="12" stroke-width="2.5" />
                    <!-- Day indicators / Handles -->
                    <line x1="10" y1="4" x2="10" y2="8" stroke-width="2.5" />
                    <line x1="22" y1="4" x2="22" y2="8" stroke-width="2.5" />
                    <!-- Checkmark/Event Success inside -->
                    <polyline points="10 18 14 22 22 14" fill="none" stroke="currentColor" stroke-width="3" />
                </svg>

                <!-- Wordmark (using standard Tailwind typography for cleaner integration) -->
                <span class="text-gray-800 dark:text-white">
                    Event
                </span>
            </a>
            <!-- End Logo Section -->


            <div class="hidden lg:block ms-2">

            </div>
        </div>

        <!-- Content -->
        <div
            class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-gray-700 dark:[&::-webkit-scrollbar-thumb]:bg-gray-500">
            <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                <ul class="flex flex-col space-y-1">
                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }} text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:text-gray-200"
                            href="{{ route('dashboard') }}">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li><a class="w-full flex items-center gap-x-3.5 py-2 px-2.5  {{ request()->routeIs('events.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }} text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-gray-700 dark:focus:bg-gray-700 dark:text-gray-200"
                            href="{{ route('events.index') }}">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                <line x1="16" x2="16" y1="2" y2="6" />
                                <line x1="8" x2="8" y1="2" y2="6" />
                                <line x1="3" x2="21" y1="10" y2="10" />
                                <path d="M8 14h.01" />
                                <path d="M12 14h.01" />
                                <path d="M16 14h.01" />
                                <path d="M8 18h.01" />
                                <path d="M12 18h.01" />
                                <path d="M16 18h.01" />
                            </svg>
                            Events
                        </a></li>
                </ul>
            </nav>
        </div>
        <!-- End Content -->
        
        <!-- Sidebar Footer -->
        <div class="mt-auto p-3 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-x-2">
                    <div class="flex-shrink-0">
                        <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Avatar">
                    </div>
                    <div class="grow">
                        <p class="text-xs font-medium text-gray-800 dark:text-gray-200">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Administrator
                        </p>
                    </div>
                </div>
                
                <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                    <button type="button" class="size-7 inline-flex justify-center items-center text-gray-500 hover:text-gray-700 focus:outline-hidden focus:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:text-gray-200" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
                    </button>
                    
                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-48 bg-white shadow-md rounded-lg mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700" aria-labelledby="hs-dropdown-with-header">
                        <div class="py-3 px-4 border-b border-gray-200 dark:border-gray-700">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Signed in as</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ auth()->user()->email }}</p>
                        </div>
                        <div class="p-1.5 space-y-0.5">
                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="#">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                                Profile
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Sidebar Footer -->
    </div>
</div>