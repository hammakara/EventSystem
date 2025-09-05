<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Explore Events' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|instrument-sans:400,500,600,700"
        rel="stylesheet" />
    <style>
        [x-cloak] {
            display: none !important
        }
        
        /* Theme-specific animations and styles */
        .theme-aurora {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .theme-cosmic {
            background: linear-gradient(135deg, #0c0c0c 0%, #1a1a2e 50%, #16213e 100%);
        }
        
        .aurora-glow {
            box-shadow: 0 0 30px rgba(102, 126, 234, 0.3), 0 0 60px rgba(118, 75, 162, 0.2);
        }
        
        .cosmic-glow {
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.3), 0 0 60px rgba(255, 20, 147, 0.2);
        }
        
        .theme-transition {
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Custom scrollbar for themes */
        .theme-aurora ::-webkit-scrollbar {
            width: 8px;
        }
        .theme-aurora ::-webkit-scrollbar-track {
            background: rgba(102, 126, 234, 0.1);
        }
        .theme-aurora ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #667eea, #764ba2);
            border-radius: 4px;
        }
        
        .theme-cosmic ::-webkit-scrollbar {
            width: 8px;
        }
        .theme-cosmic ::-webkit-scrollbar-track {
            background: rgba(0, 255, 255, 0.1);
        }
        .theme-cosmic ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #00ffff, #ff1493);
            border-radius: 4px;
        }
    </style>
    <meta name="description" content="Explore upcoming events, venues, and organizers. Find and manage events with a modern, responsive UI.">
    <meta property="og:title" content="{{ $title ?? 'Explore Events' }}" />
    <meta property="og:description" content="Discover events by type, date, organizer, or venue." />
    <meta property="og:type" content="website" />
</head>

<body x-data="{ 
    theme: localStorage.getItem('theme') || 'aurora',
    showMobileMenu: false,
    isLoading: false,
    particles: true,
    showThemeSelector: false
  }" 
  x-init="
    $watch('theme', v => { 
        localStorage.setItem('theme', v); 
        document.body.className = document.body.className.replace(/theme-\w+/g, '');
        document.body.classList.add('theme-' + v);
    });
    // Set initial theme
    document.body.classList.add('theme-' + theme);
    // Page load animation
    setTimeout(() => { document.body.classList.add('loaded') }, 100);
  "
  :class="`min-h-screen antialiased opacity-0 transition-opacity duration-700 ease-out theme-transition ${
    theme === 'aurora' 
      ? 'bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 text-gray-900' 
      : 'bg-gradient-to-br from-gray-900 via-purple-900 to-violet-900 text-white'
  }`">
  
  <!-- Dynamic Theme Particles Background -->
  <div x-show="particles" class="fixed inset-0 overflow-hidden pointer-events-none z-0">
    <!-- Aurora Theme Particles -->
    <template x-if="theme === 'aurora'">
        <div>
            <div class="absolute top-20 left-20 w-4 h-4 bg-indigo-400 rounded-full animate-bounce opacity-60"></div>
            <div class="absolute top-40 right-32 w-3 h-3 bg-purple-400 rounded-full animate-pulse opacity-50" style="animation-delay: 1s"></div>
            <div class="absolute bottom-32 left-1/4 w-5 h-5 bg-pink-400 rounded-full animate-ping opacity-40" style="animation-delay: 2s"></div>
            <div class="absolute top-1/3 right-20 w-2 h-2 bg-indigo-500 rounded-full animate-bounce opacity-70" style="animation-delay: 0.5s"></div>
            <div class="absolute bottom-20 right-1/3 w-3 h-3 bg-purple-500 rounded-full animate-pulse opacity-50" style="animation-delay: 1.5s"></div>
            <div class="absolute top-60 left-1/2 w-4 h-4 bg-pink-500 rounded-full animate-ping opacity-60" style="animation-delay: 3s"></div>
        </div>
    </template>
    
    <!-- Cosmic Theme Particles -->
    <template x-if="theme === 'cosmic'">
        <div>
            <div class="absolute top-20 left-20 w-2 h-2 bg-cyan-400 rounded-full animate-pulse opacity-80"></div>
            <div class="absolute top-40 right-32 w-1 h-1 bg-pink-400 rounded-full animate-ping opacity-70" style="animation-delay: 1s"></div>
            <div class="absolute bottom-32 left-1/4 w-3 h-3 bg-green-400 rounded-full animate-bounce opacity-60" style="animation-delay: 2s"></div>
            <div class="absolute top-1/3 right-20 w-1 h-1 bg-yellow-400 rounded-full animate-pulse opacity-90" style="animation-delay: 0.5s"></div>
            <div class="absolute bottom-20 right-1/3 w-2 h-2 bg-blue-400 rounded-full animate-ping opacity-50" style="animation-delay: 1.5s"></div>
            <div class="absolute top-60 left-1/2 w-1 h-1 bg-purple-400 rounded-full animate-bounce opacity-80" style="animation-delay: 3s"></div>
        </div>
    </template>
  </div>

  <a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:left-2 focus:top-2 z-50 bg-white dark:bg-gray-900 px-3 py-1 rounded">Skip to content</a>
  
  <!-- Enhanced Header with Theme Options -->
  <header :class="`sticky top-0 z-40 backdrop-blur-xl theme-transition ${
    theme === 'aurora' 
      ? 'bg-white/80 border-b border-indigo-100' 
      : 'bg-gray-900/80 border-b border-purple-500/30'
  }`">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div :class="`mt-3 mb-3 h-16 rounded-2xl border shadow-lg ring-1 flex items-center justify-between px-6 theme-transition ${
          theme === 'aurora' 
            ? 'border-indigo-200 bg-white/90 ring-indigo-100 aurora-glow' 
            : 'border-purple-500/50 bg-gray-900/90 ring-purple-400/30 cosmic-glow'
        }`">
            <a href="/explore" :class="`inline-flex items-center gap-3 font-bold text-xl theme-transition ${
              theme === 'aurora' ? 'text-gray-900' : 'text-white'
            }`">
                <div :class="`inline-flex h-10 w-10 items-center justify-center rounded-xl shadow-lg theme-transition ${
                  theme === 'aurora' 
                    ? 'bg-gradient-to-r from-indigo-500 to-purple-600' 
                    : 'bg-gradient-to-r from-cyan-400 to-pink-500'
                }`">
                    <span class="text-white font-bold">EM</span>
                </div>
                <span class="hidden sm:block">Event Management</span>
            </a>
            
            <nav class="flex items-center gap-1 text-sm">
                <a href="/explore" :class="`inline-flex items-center gap-2 rounded-xl px-4 py-2.5 font-medium transition-all duration-300 ${
                  theme === 'aurora' 
                    ? 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 ' + (request()->routeIs('client.events.*') ? 'bg-indigo-100 text-indigo-700' : '')
                    : 'text-gray-300 hover:text-cyan-400 hover:bg-gray-800 ' + (request()->routeIs('client.events.*') ? 'bg-gray-800 text-cyan-400' : '')
                }`">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Explore</span>
                </a>

                @if (Auth::check())
                    <a href="{{ route('client.events.index') }}" :class="`inline-flex items-center gap-2 rounded-xl px-4 py-2.5 font-medium transition-all duration-300 ${
                      theme === 'aurora' 
                        ? 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50'
                        : 'text-gray-300 hover:text-cyan-400 hover:bg-gray-800'
                    }`">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    @if (!auth()->user()->hasRole('admin'))
                        <form method="POST" action="{{ route('logout') }}" class="inline-block">
                            @csrf
                            <button type="submit" :class="`inline-flex items-center gap-2 rounded-xl px-4 py-2.5 font-medium transition-all duration-300 ${
                              theme === 'aurora' 
                                ? 'text-gray-700 hover:text-red-600 hover:bg-red-50'
                                : 'text-gray-300 hover:text-red-400 hover:bg-red-900/20'
                            }`">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" :class="`inline-flex items-center gap-2 rounded-xl px-4 py-2.5 font-medium transition-all duration-300 ${
                      theme === 'aurora' 
                        ? 'text-gray-700 hover:text-indigo-600 hover:bg-indigo-50'
                        : 'text-gray-300 hover:text-cyan-400 hover:bg-gray-800'
                    }`">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Login</span>
                    </a>
                @endif

                <!-- Theme Selector Button -->
                <div class="relative ml-2">
                    <button type="button"
                        @click="showThemeSelector = !showThemeSelector"
                        :class="`inline-flex items-center justify-center rounded-xl border px-3 py-2 text-sm font-medium transition-all duration-300 ${
                          theme === 'aurora' 
                            ? 'border-indigo-200 bg-white hover:bg-indigo-50 text-gray-700'
                            : 'border-purple-500/50 bg-gray-800 hover:bg-gray-700 text-gray-300'
                        }`">
                        <span x-show="theme === 'aurora'" class="text-lg">🌅</span>
                        <span x-show="theme === 'cosmic'" class="text-lg">🌌</span>
                        <svg class="ml-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    
                    <!-- Theme Selector Dropdown -->
                    <div x-show="showThemeSelector" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="showThemeSelector = false"
                         :class="`absolute right-0 top-full mt-2 w-48 rounded-xl shadow-xl ring-1 z-50 theme-transition ${
                           theme === 'aurora' 
                             ? 'bg-white border border-indigo-100 ring-indigo-100'
                             : 'bg-gray-900 border border-purple-500/30 ring-purple-400/30'
                         }`">
                        <div class="p-2">
                            <button @click="theme = 'aurora'; showThemeSelector = false"
                                    :class="`w-full flex items-center gap-3 rounded-lg px-3 py-2 text-sm transition-colors ${
                                      theme === 'aurora' 
                                        ? 'bg-indigo-100 text-indigo-700' 
                                        : 'text-gray-700 hover:bg-indigo-50'
                                    }`">
                                <span class="text-lg">🌅</span>
                                <div class="flex-1 text-left">
                                    <div class="font-medium">Aurora</div>
                                    <div class="text-xs opacity-75">Light & dreamy</div>
                                </div>
                                <div x-show="theme === 'aurora'" class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                            </button>
                            
                            <button @click="theme = 'cosmic'; showThemeSelector = false"
                                    :class="`w-full flex items-center gap-3 rounded-lg px-3 py-2 text-sm transition-colors ${
                                      theme === 'cosmic' 
                                        ? 'bg-purple-900/50 text-purple-300' 
                                        : 'text-gray-300 hover:bg-gray-800'
                                    }`">
                                <span class="text-lg">🌌</span>
                                <div class="flex-1 text-left">
                                    <div class="font-medium">Cosmic</div>
                                    <div class="text-xs opacity-75">Dark & mysterious</div>
                                </div>
                                <div x-show="theme === 'cosmic'" class="w-2 h-2 bg-purple-400 rounded-full"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

<main id="content" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
  <x-ui.flash />
  @yield('content')
</main>

<!-- Enhanced Footer -->
<footer :class="`relative mt-16 border-t py-16 theme-transition ${
  theme === 'aurora' 
    ? 'border-indigo-100 bg-gradient-to-t from-indigo-50/50 to-transparent'
    : 'border-purple-500/30 bg-gradient-to-t from-gray-900/50 to-transparent'
}`">
    <!-- Dynamic background blobs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div :class="`absolute -top-24 -right-24 w-64 h-64 rounded-full blur-3xl opacity-20 ${
          theme === 'aurora' ? 'bg-gradient-to-br from-indigo-400 to-purple-600' : 'bg-gradient-to-br from-cyan-400 to-pink-600'
        }`"></div>
        <div :class="`absolute -bottom-24 -left-24 w-64 h-64 rounded-full blur-3xl opacity-20 ${
          theme === 'aurora' ? 'bg-gradient-to-tr from-pink-400 to-purple-600' : 'bg-gradient-to-tr from-green-400 to-blue-600'
        }`"></div>
    </div>
    
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
            <div class="md:col-span-2">
                <a href="/explore" :class="`inline-flex items-center gap-3 font-bold text-xl ${
                  theme === 'aurora' ? 'text-gray-900' : 'text-white'
                }`">
                    <div :class="`inline-flex h-10 w-10 items-center justify-center rounded-xl shadow-lg ${
                      theme === 'aurora' 
                        ? 'bg-gradient-to-r from-indigo-500 to-purple-600' 
                        : 'bg-gradient-to-r from-cyan-400 to-pink-500'
                    }`">
                        <span class="text-white font-bold">EM</span>
                    </div>
                    <span>Event Management</span>
                </a>
                <p :class="`mt-4 max-w-md text-sm ${
                  theme === 'aurora' ? 'text-gray-600' : 'text-gray-400'
                }`">
                    Discover and organize events with a clean, fast experience powered by Laravel, Tailwind, and Alpine. 
                    Crafted for performance and clarity with beautiful themes.
                </p>
                <div class="mt-6 flex items-center gap-3">
                    <a href="#" :class="`inline-flex h-10 w-10 items-center justify-center rounded-xl border transition-colors ${
                      theme === 'aurora' 
                        ? 'border-indigo-200 hover:bg-indigo-50 text-gray-600' 
                        : 'border-purple-500/30 hover:bg-gray-800 text-gray-400'
                    }`" aria-label="Twitter">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.633 7.997c.013.177.013.354.013.53 0 5.408-4.117 11.648-11.648 11.648-2.317 0-4.47-.676-6.279-1.84.322.038.631.05.966.05a8.24 8.24 0 0 0 5.106-1.758 4.12 4.12 0 0 1-3.845-2.85c.25.038.5.063.762.063.366 0 .733-.05 1.075-.139a4.114 4.114 0 0 1-3.297-4.036v-.051c.55.304 1.188.49 1.862.514a4.108 4.108 0 0 1-1.833-3.417c0-.762.203-1.45.558-2.053a11.684 11.684 0 0 0 8.48 4.305 4.635 4.635 0 0 1-.101-.94 4.112 4.112 0 0 1 7.12-2.81 8.135 8.135 0 0 0 2.606-.993 4.13 4.13 0 0 1-1.808 2.27 8.221 8.221 0 0 0 2.366-.64 8.845 8.845 0 0 1-2.062 2.133Z" />
                        </svg>
                    </a>
                    <a href="#" :class="`inline-flex h-10 w-10 items-center justify-center rounded-xl border transition-colors ${
                      theme === 'aurora' 
                        ? 'border-indigo-200 hover:bg-indigo-50 text-gray-600' 
                        : 'border-purple-500/30 hover:bg-gray-800 text-gray-400'
                    }`" aria-label="GitHub">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.486 2 12.018c0 4.424 2.865 8.18 6.838 9.504.5.092.682-.218.682-.485 0-.239-.009-.87-.014-1.707-2.782.604-3.369-1.343-3.369-1.343-.454-1.156-1.11-1.465-1.11-1.465-.908-.62.069-.607.069-.607 1.004.071 1.532 1.032 1.532 1.032.892 1.531 2.341 1.088 2.91.833.092-.647.35-1.088.635-1.339-2.22-.253-4.555-1.112-4.555-4.946 0-1.092.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0 1 12 6.844c.852.004 1.71.115 2.511.338 1.909-1.296 2.748-1.026 2.748-1.026.546 1.378.203 2.397.1 2.65.64.7 1.027 1.596 1.027 2.688 0 3.842-2.339 4.69-4.566 4.94.36.309.678.919.678 1.852 0 1.336-.012 2.412-.012 2.741 0 .269.18.581.688.482A10.02 10.02 0 0 0 22 12.018C22 6.486 17.523 2 12 2Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
            <div>
                <h3 :class="`text-sm font-bold mb-4 ${theme === 'aurora' ? 'text-gray-900' : 'text-white'}`">Explore</h3>
                <ul :class="`space-y-3 text-sm ${theme === 'aurora' ? 'text-gray-600' : 'text-gray-400'}`">
                    <li><a href="{{ route('client.events.index') }}" :class="`transition-colors ${theme === 'aurora' ? 'hover:text-indigo-600' : 'hover:text-cyan-400'}`">All events</a></li>
                    <li><a href="{{ route('client.events.index', ['status' => 'upcoming']) }}" :class="`transition-colors ${theme === 'aurora' ? 'hover:text-indigo-600' : 'hover:text-cyan-400'}`">Upcoming</a></li>
                    <li><a href="{{ route('client.events.index', ['status' => 'past']) }}" :class="`transition-colors ${theme === 'aurora' ? 'hover:text-indigo-600' : 'hover:text-cyan-400'}`">Past</a></li>
                </ul>
            </div>
            <div>
                <h3 :class="`text-sm font-bold mb-4 ${theme === 'aurora' ? 'text-gray-900' : 'text-white'}`">Categories</h3>
                <ul :class="`space-y-3 text-sm ${theme === 'aurora' ? 'text-gray-600' : 'text-gray-400'}`">
                    @foreach (['Technology', 'Music', 'Art & Design', 'Food & Culinary', 'Outdoor & Adventure'] as $t)
                        <li><a href="{{ route('client.events.index', ['type' => $t]) }}" :class="`transition-colors ${theme === 'aurora' ? 'hover:text-indigo-600' : 'hover:text-cyan-400'}`">{{ $t }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div :class="`mt-12 flex flex-col items-center justify-between gap-4 border-t pt-8 sm:flex-row ${
          theme === 'aurora' ? 'border-indigo-200' : 'border-purple-500/30'
        }`">
            <p :class="`text-xs ${theme === 'aurora' ? 'text-gray-500' : 'text-gray-400'}`">
                © {{ date('Y') }} Event Management. All rights reserved.
            </p>
            <div :class="`text-xs ${theme === 'aurora' ? 'text-gray-500' : 'text-gray-400'}`">
                Made with <span :class="theme === 'aurora' ? 'text-purple-600' : 'text-pink-400'">♥</span> using Laravel & Tailwind
            </div>
        </div>
    </div>
</footer>

<script>
    // Enhanced theme switching with smooth transitions
    document.addEventListener('alpine:init', () => {
        // Add smooth transition class to body after Alpine initializes
        setTimeout(() => {
            document.body.classList.add('loaded');
        }, 100);
    });
</script>

</body>
</html>
