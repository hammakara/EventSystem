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
    </style>
    <meta name="description" content="Explore upcoming events, venues, and organizers. Find and manage events with a modern, responsive UI.">
    <meta property="og:title" content="{{ $title ?? 'Explore Events' }}" />
    <meta property="og:description" content="Discover events by type, date, organizer, or venue." />
    <meta property="og:type" content="website" />
  </head>

<body x-data="{ 
    theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
    showMobileMenu: false,
    isLoading: false,
    particles: true
  }" 
  x-init="
    if (theme === 'dark') { document.documentElement.classList.add('dark') } else { document.documentElement.classList.remove('dark') };
    $watch('theme', v => { localStorage.setItem('theme', v); if (v === 'dark') { document.documentElement.classList.add('dark') } else { document.documentElement.classList.remove('dark') } });
    // Page load animation
    setTimeout(() => { document.body.classList.add('loaded') }, 100);
  "
  class="min-h-screen bg-gradient-to-br from-[#f6f3ff] via-[#f9f7ff] to-[#f3f6ff] text-neutral-900 dark:from-neutral-900 dark:via-neutral-900 dark:to-neutral-900 dark:text-neutral-100 antialiased opacity-0 transition-opacity duration-700 ease-out">
  
  <!-- Cute Floating Particles Background -->
  <div x-show="particles" class="fixed inset-0 overflow-hidden pointer-events-none z-0">
    <div class="absolute top-20 left-20 w-3 h-3 bg-pink-300 rounded-full float-cute opacity-60"></div>
    <div class="absolute top-40 right-32 w-2 h-2 bg-purple-300 rounded-full float-cute opacity-50" style="animation-delay: 1s"></div>
    <div class="absolute bottom-32 left-1/4 w-4 h-4 bg-indigo-300 rounded-full float-cute opacity-40" style="animation-delay: 2s"></div>
    <div class="absolute top-1/3 right-20 w-2 h-2 bg-fuchsia-300 rounded-full float-cute opacity-70" style="animation-delay: 0.5s"></div>
    <div class="absolute bottom-20 right-1/3 w-3 h-3 bg-cyan-300 rounded-full float-cute opacity-50" style="animation-delay: 1.5s"></div>
    <div class="absolute top-60 left-1/2 w-2 h-2 bg-violet-300 rounded-full float-cute opacity-60" style="animation-delay: 3s"></div>
  </div>
    <a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:left-2 focus:top-2 z-50 bg-white dark:bg-neutral-900 text-neutral-700 dark:text-neutral-200 px-3 py-1 rounded">Skip to content</a>
    <header class="sticky top-0 z-40 bg-white/80 dark:bg-neutral-900/80 backdrop-blur">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                class="mt-3 mb-3 h-14 rounded-full border border-violet-100 dark:border-neutral-800 bg-white/90 dark:bg-neutral-900/90 shadow-sm ring-1 ring-violet-100 dark:ring-neutral-800 flex items-center justify-between px-4">
                <a href="/explore"
                    class="inline-flex items-center gap-2 font-semibold text-neutral-900 dark:text-neutral-100">
                    <span
                        class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-fuchsia-500 to-indigo-500 text-white">EM</span>
                    <span class="hidden sm:block">Event Management</span>
                </a>
                <nav class="flex items-center gap-2 text-sm">
                    <a href="/explore"
                        class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-neutral-700 dark:text-neutral-300 hover:text-neutral-900 hover:bg-violet-50 dark:hover:bg-neutral-800 {{ request()->routeIs('client.events.*') ? 'bg-violet-50 text-neutral-900 dark:bg-neutral-800' : '' }}">
                        <span>Explore</span>
                    </a>

                    @if (Auth::check())
                        <a href="{{ route('client.events.index') }}"
                            class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-neutral-600 dark:text-neutral-300 hover:text-neutral-900 hover:bg-violet-50 dark:hover:bg-neutral-800">
                            <span>Dashboard</span>
                        </a>

                        @if (!auth()->user()->hasRole('admin'))
                            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-neutral-600 dark:text-neutral-300 hover:text-neutral-900 hover:bg-violet-50 dark:hover:bg-neutral-800">
                                    <span>Logout</span>
                                </button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-neutral-600 dark:text-neutral-300 hover:text-neutral-900 hover:bg-violet-50 dark:hover:bg-neutral-800">
                            <span>Login</span>
                        </a>
                    @endif

                    <button type="button"
                        class="ml-1 inline-flex items-center justify-center rounded-full border border-violet-100 dark:border-neutral-800 px-2.5 py-1.5 text-xs"
                        x-on:click="theme = theme==='dark' ? 'light' : 'dark'"
                        :aria-label="theme === 'dark' ? 'Switch to light' : 'Switch to dark'">
                        <span x-show="theme!=='dark'" x-cloak>🌙</span>
                        <span x-show="theme==='dark'" x-cloak>☀️</span>
                    </button>
                </nav>
            </div>
        </div>
    </header>

    <main id="content" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
      <x-ui.flash />
      @yield('content')
    </main>

    <footer class="relative mt-8 border-t border-violet-100 dark:border-neutral-800 py-12">
        <div class="absolute -top-20 -right-24 h-40 w-40 rounded-full bg-fuchsia-300/20 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 h-40 w-40 rounded-full bg-indigo-300/20 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div class="md:col-span-2">
                    <a href="/explore" class="inline-flex items-center gap-2 font-semibold">
                        <span
                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-gradient-to-r from-fuchsia-500 to-indigo-500 text-white">EM</span>
                        <span>Event Management</span>
                    </a>
                    <p class="mt-3 max-w-md text-sm text-neutral-600 dark:text-neutral-400">Discover and organize events
                        with a clean, fast experience powered by Laravel, Tailwind, and Alpine. Crafted for performance
                        and clarity.</p>
                    <div class="mt-4 flex items-center gap-3 text-neutral-500">
                        <a href="#"
                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-violet-100 dark:border-neutral-800 hover:bg-violet-50 dark:hover:bg-neutral-800"
                            aria-label="Twitter">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M19.633 7.997c.013.177.013.354.013.53 0 5.408-4.117 11.648-11.648 11.648-2.317 0-4.47-.676-6.279-1.84.322.038.631.05.966.05a8.24 8.24 0 0 0 5.106-1.758 4.12 4.12 0 0 1-3.845-2.85c.25.038.5.063.762.063.366 0 .733-.05 1.075-.139a4.114 4.114 0 0 1-3.297-4.036v-.051c.55.304 1.188.49 1.862.514a4.108 4.108 0 0 1-1.833-3.417c0-.762.203-1.45.558-2.053a11.684 11.684 0 0 0 8.48 4.305 4.635 4.635 0 0 1-.101-.94 4.112 4.112 0 0 1 7.12-2.81 8.135 8.135 0 0 0 2.606-.993 4.13 4.13 0 0 1-1.808 2.27 8.221 8.221 0 0 0 2.366-.64 8.845 8.845 0 0 1-2.062 2.133Z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-violet-100 dark:border-neutral-800 hover:bg-violet-50 dark:hover:bg-neutral-800"
                            aria-label="GitHub">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.486 2 12.018c0 4.424 2.865 8.18 6.838 9.504.5.092.682-.218.682-.485 0-.239-.009-.87-.014-1.707-2.782.604-3.369-1.343-3.369-1.343-.454-1.156-1.11-1.465-1.11-1.465-.908-.62.069-.607.069-.607 1.004.071 1.532 1.032 1.532 1.032.892 1.531 2.341 1.088 2.91.833.092-.647.35-1.088.635-1.339-2.22-.253-4.555-1.112-4.555-4.946 0-1.092.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0 1 12 6.844c.852.004 1.71.115 2.511.338 1.909-1.296 2.748-1.026 2.748-1.026.546 1.378.203 2.397.1 2.65.64.7 1.027 1.596 1.027 2.688 0 3.842-2.339 4.69-4.566 4.94.36.309.678.919.678 1.852 0 1.336-.012 2.412-.012 2.741 0 .269.18.581.688.482A10.02 10.02 0 0 0 22 12.018C22 6.486 17.523 2 12 2Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-neutral-900 dark:text-neutral-100">Explore</h3>
                    <ul class="mt-3 space-y-2 text-sm text-neutral-600 dark:text-neutral-400">
                        <li><a href="{{ route('client.events.index') }}" class="hover:text-neutral-900">All events</a>
                        </li>
                        <li><a href="{{ route('client.events.index', ['status' => 'upcoming']) }}"
                                class="hover:text-neutral-900">Upcoming</a></li>
                        <li><a href="{{ route('client.events.index', ['status' => 'past']) }}"
                                class="hover:text-neutral-900">Past</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-neutral-900 dark:text-neutral-100">Categories</h3>
                    <ul class="mt-3 space-y-2 text-sm text-neutral-600 dark:text-neutral-400">
                        @foreach (['Technology', 'Music', 'Art & Design', 'Food & Culinary', 'Outdoor & Adventure'] as $t)
                            <li><a href="{{ route('client.events.index', ['type' => $t]) }}"
                                    class="hover:text-neutral-900">{{ $t }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div
                class="mt-10 flex flex-col items-center justify-between gap-3 border-t border-violet-100 dark:border-neutral-800 pt-6 sm:flex-row">
                <p class="text-xs text-neutral-500">© {{ date('Y') }} Event Management. All rights reserved.</p>
                <div class="text-xs text-neutral-500">Made with <span class="text-fuchsia-600">♥</span> using Laravel &
                    Tailwind</div>
            </div>
        </div>
    </footer>
</body>

</html>
