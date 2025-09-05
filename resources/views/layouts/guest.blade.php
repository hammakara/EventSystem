<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#8b5cf6">

    <title>{{ config('app.name', 'Event Management') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900|space-grotesk:300,400,500,600,700"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        html {
            font-family: 'Space Grotesk', 'Inter', system-ui, sans-serif;
        }

        .gradient-mesh {
            background:
                radial-gradient(at 40% 20%, hsla(228, 100%, 74%, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189, 100%, 56%, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 50%, hsla(355, 100%, 93%, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 50%, hsla(340, 100%, 76%, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(22, 100%, 77%, 0.1) 0px, transparent 50%),
                radial-gradient(at 80% 100%, hsla(242, 100%, 70%, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 0%, hsla(343, 100%, 76%, 0.1) 0px, transparent 50%);
        }

        .dark .gradient-mesh {
            background:
                radial-gradient(at 40% 20%, hsla(228, 100%, 74%, 0.05) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189, 100%, 56%, 0.05) 0px, transparent 50%),
                radial-gradient(at 0% 50%, hsla(355, 100%, 93%, 0.05) 0px, transparent 50%),
                radial-gradient(at 80% 50%, hsla(340, 100%, 76%, 0.05) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(22, 100%, 77%, 0.05) 0px, transparent 50%),
                radial-gradient(at 80% 100%, hsla(242, 100%, 70%, 0.05) 0px, transparent 50%),
                radial-gradient(at 0% 0%, hsla(343, 100%, 76%, 0.05) 0px, transparent 50%);
        }

        .animated-bg {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes particle-float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(30px, -30px) rotate(120deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(240deg);
            }
        }

        .glass-card-pro {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow:
                0 8px 32px 0 rgba(31, 38, 135, 0.15),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.2);
        }

        .dark .glass-card-pro {
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow:
                0 8px 32px 0 rgba(0, 0, 0, 0.3),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body
    class="font-sans antialiased min-h-screen bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 relative overflow-hidden transition-colors duration-500">
    <!-- Animated Background Mesh -->
    <div class="fixed inset-0 gradient-mesh"></div>

    <!-- Floating Orbs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="floating-orb floating-orb-1"></div>
        <div class="floating-orb floating-orb-2"></div>
        <div class="floating-orb floating-orb-3"></div>
    </div>

    <!-- Dark Mode Toggle -->
    <div class="fixed top-6 right-6 z-50">
        <div class="glass-card-pro rounded-2xl p-1 hover-lift-subtle">
            <x-dark-mode-toggle class="transition-transform duration-300 hover:scale-110" />
        </div>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center px-6 relative z-10">


        <!-- Main auth card with professional glassmorphism -->
        <div class="w-full sm:max-w-lg overflow-hidden rounded-3xl glass-card-pro p-8 hover-lift-subtle transition-all duration-700"
            x-data="{
                formFocus: false,
                mounted: false
            }" x-init="setTimeout(() => mounted = true, 100)"
            :class="{
                'shadow-2xl shadow-violet-500/10': formFocus,
                'opacity-100 translate-y-0': mounted,
                'opacity-0 translate-y-8': !mounted
            }"
            @focusin="formFocus = true" @focusout="formFocus = false">

            <!-- Card highlight border -->
            <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-violet-500/20 via-purple-500/20 to-indigo-500/20 opacity-0 transition-opacity duration-500"
                :class="{ 'opacity-100': formFocus }"></div>

            <div class="relative z-10">
                {{ $slot }}
            </div>

            <!-- Professional footer -->
            <div class="mt-8 text-center relative z-10">
                <div class="flex items-center justify-center gap-6 text-xs text-slate-500 dark:text-slate-400">
                    <a href="{{ route('client.events.index') }}"
                        class="inline-flex items-center gap-2 hover:text-violet-600 dark:hover:text-violet-400 transition-colors duration-200 group">
                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                        <span class="font-medium">Explore Events</span>
                    </a>
                    <div class="w-px h-4 bg-slate-300 dark:bg-slate-600"></div>

                </div>

            </div>
        </div>
    </div>
</body>

</html>
