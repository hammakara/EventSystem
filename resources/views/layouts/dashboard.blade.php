<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard' }} • EventHub</title>

    <!-- Tailwind via CDN for quick prototyping -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f5f3ff', 100: '#ede9fe', 200: '#ddd6fe', 300: '#c4b5fd',
                            400: '#a78bfa', 500: '#8b5cf6', 600: '#7c3aed', 700: '#6d28d9',
                            800: '#5b21b6', 900: '#4c1d95'
                        },
                        brand: '#8B5CF6',
                        cute: {
                            pink: '#ff6b9d',
                            purple: '#c44cff', 
                            blue: '#4facfe',
                            green: '#43e794',
                            orange: '#ff8a56',
                            yellow: '#ffd93d'
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 3s infinite',
                        'wiggle': 'wiggle 1s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        wiggle: {
                            '0%, 100%': { transform: 'rotate(-3deg)' },
                            '50%': { transform: 'rotate(3deg)' },
                        }
                    },
                    backdropBlur: {
                        'xs': '2px',
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Heroicons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|instrument-sans:400,500,600,700" rel="stylesheet" />
</head>
<body class="h-full bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50 dark:bg-gradient-to-br dark:from-neutral-900 dark:via-purple-900/20 dark:to-blue-900/20 text-neutral-900 dark:text-neutral-100 relative overflow-x-hidden">

<!-- Animated Background Elements -->
<div class="fixed inset-0 pointer-events-none overflow-hidden">
    <div class="absolute top-10 left-10 w-20 h-20 bg-gradient-to-r from-pink-300 to-purple-300 rounded-full opacity-20 animate-float"></div>
    <div class="absolute top-32 right-20 w-16 h-16 bg-gradient-to-r from-blue-300 to-cyan-300 rounded-full opacity-20 animate-bounce-slow"></div>
    <div class="absolute bottom-20 left-20 w-24 h-24 bg-gradient-to-r from-green-300 to-emerald-300 rounded-full opacity-20 animate-pulse-slow"></div>
    <div class="absolute bottom-40 right-32 w-12 h-12 bg-gradient-to-r from-yellow-300 to-orange-300 rounded-full opacity-20 animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 right-10 w-8 h-8 bg-gradient-to-r from-purple-300 to-pink-300 rounded-full opacity-30 animate-bounce-slow" style="animation-delay: 1s;"></div>
</div>

<div class="min-h-screen relative z-10"
     x-data="{
         sidebarCollapsed: window.innerWidth < 1024 ? true : false,
         sidebarMobileOpen: false,
         toggleCollapse() {
             this.sidebarCollapsed = !this.sidebarCollapsed;
             localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
         },
         toggleMobile() {
             this.sidebarMobileOpen = !this.sidebarMobileOpen;
         },
         init() {
             // Restore sidebar state from localStorage
             const saved = localStorage.getItem('sidebarCollapsed');
             if (saved !== null) {
                 this.sidebarCollapsed = saved === 'true';
             }
             
             // Handle resize events
             window.addEventListener('resize', () => {
                 if (window.innerWidth < 768) {
                     this.sidebarMobileOpen = false;
                 }
             });
             
             // Close mobile sidebar when clicking outside
             document.addEventListener('click', (e) => {
                 if (this.sidebarMobileOpen && !e.target.closest('aside') && !e.target.closest('[data-mobile-toggle]')) {
                     this.sidebarMobileOpen = false;
                 }
             });
             
             // Keyboard shortcuts
             document.addEventListener('keydown', (e) => {
                 if (e.ctrlKey && e.key === 'b') {
                     e.preventDefault();
                     if (window.innerWidth >= 768) {
                         this.toggleCollapse();
                     } else {
                         this.toggleMobile();
                     }
                 }
             });
         }
     }">
    <!-- Mobile backdrop overlay -->
    <div x-show="sidebarMobileOpen" x-cloak
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-neutral-900/50 backdrop-blur-sm z-40 md:hidden"
         x-on:click="sidebarMobileOpen = false"></div>
    
    <!-- Mobile menu toggle button -->
    <div class="md:hidden fixed top-4 left-4 z-50">
        <button data-mobile-toggle
                class="inline-flex items-center justify-center p-2 rounded-xl bg-white/90 backdrop-blur-sm border border-violet-100 dark:bg-neutral-900/90 dark:border-neutral-800 text-neutral-700 dark:text-neutral-300 shadow-lg"
                x-on:click="toggleMobile()" 
                :aria-expanded="sidebarMobileOpen"
                aria-label="Toggle navigation menu">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path x-show="!sidebarMobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="sidebarMobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    
    <div class="flex">
        <!-- Desktop Sidebar -->
        <x-dashboard.sidebar />
        
        <!-- Mobile Sidebar -->
        <x-dashboard.sidebar-mobile />

        <!-- Main content -->
        <div class="flex-1 min-w-0 transition-all duration-300 ease-in-out relative"
             x-bind:class="{
                 'md:ml-0': true,
                 'pt-16 px-4': window.innerWidth < 768,
                 'md:px-6 lg:px-8': window.innerWidth >= 768
             }"
             x-bind:style="{
                 marginLeft: window.innerWidth >= 768 && sidebarCollapsed ? '5rem' : '0',
                 paddingLeft: window.innerWidth >= 768 ? (sidebarCollapsed ? '1rem' : '1.5rem') : '1rem'
             }">
            <div class="max-w-full mx-auto">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

</body>
</html>
