@php($title = 'Dashboard')
<x-layouts.dashboard :title="$title">
    <div class="p-4 lg:p-6">
        <div class="max-w-[1400px] mx-auto space-y-8">
            <!-- Welcome Header -->
            <div class="text-center py-8">
                <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 bg-clip-text text-transparent mb-2">Welcome to Ventixe ✨</h1>
                <p class="text-neutral-600 dark:text-neutral-400">Your event management dashboard, cute and modern</p>
            </div>
            
            <!-- KPI cards driven by ERD -->
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <x-dashboard.stat-card title="Upcoming events" :value="$totals['events_upcoming']" sub="scheduled ≥ today" :icon="'<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'w-5 h-5\' viewBox=\'0 0 24 24\' fill=\'currentColor\'><path d=\'M3 13.5l6-6 4.5 4.5L21 4.5v15H3z\'/></svg>'" />
                <x-dashboard.stat-card title="Past events" :value="$totals['events_past']" sub="already happened" accent="from-sky-500 to-indigo-500" :icon="'<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'w-5 h-5\' viewBox=\'0 0 24 24\' fill=\'currentColor\'><path d=\'M12 7.5v9M7.5 12h9\'/></svg>'" />
                <x-dashboard.stat-card title="Attendees" :value="$totals['attendees']" sub="total" accent="from-emerald-500 to-teal-500" :icon="'<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'w-5 h-5\' viewBox=\'0 0 24 24\' fill=\'currentColor\'><path d=\'M12 6.75a3 3 0 110 6 3 3 0 010-6zM4.5 18a7.5 7.5 0 1115 0v.75H4.5V18z\'/></svg>'" />
                <x-dashboard.stat-card title="Venues" :value="$totals['venues']" sub="locations" accent="from-amber-500 to-pink-500" :icon="'<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'w-5 h-5\' viewBox=\'0 0 24 24\' fill=\'currentColor\'><path d=\'M3 9.75L12 3l9 6.75V21H3V9.75z\'/></svg>'" />
                <x-dashboard.stat-card title="Vendors" :value="$totals['vendors']" sub="service providers" accent="from-fuchsia-500 to-indigo-500" :icon="'<svg xmlns=\'http://www.w3.org/2000/svg\' class=\'w-5 h-5\' viewBox=\'0 0 24 24\' fill=\'currentColor\'><path d=\'M9 6l2-3 2 3-2 3-2-3zM3 15l2-3 2 3-2 3-2-3zM15 15l2-3 2 3-2 3-2-3z\'/></svg>'" />
            </section>

            <!-- Middle area -->
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Revenue chart (sum of vendor fees per day) -->
                <div class="lg:col-span-2 rounded-3xl bg-white/70 backdrop-blur-md border border-white/40 p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 dark:bg-neutral-900/60 dark:border-neutral-700/40">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-neutral-800 dark:text-neutral-100">Revenue (last 7 days) 📊</h3>
                            <p class="text-sm text-neutral-500">Sum of vendor fees for events per day</p>
                        </div>
                    </div>
                    <div class="mt-6 p-4 rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20">
                        <canvas id="revenueChart" height="110"></canvas>
                    </div>
                </div>

                <!-- Top venues -->
                <div class="rounded-3xl bg-white/70 backdrop-blur-md border border-white/40 p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 dark:bg-neutral-900/60 dark:border-neutral-700/40">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center text-white shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-neutral-800 dark:text-neutral-100">Top venues 🏟️</h3>
                            <p class="text-xs text-neutral-500">by upcoming events</p>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        @forelse($topVenues as $index => $v)
                            <li class="group flex items-center justify-between p-3 rounded-2xl bg-gradient-to-r from-white/50 to-purple-50/50 dark:from-neutral-800/50 dark:to-purple-900/20 border border-white/30 hover:shadow-md transition-all duration-300 hover:scale-105">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white text-sm font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                    <span class="font-medium text-neutral-700 dark:text-neutral-300">{{ $v->name }}</span>
                                </div>
                                <span class="text-sm bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 px-2 py-1 rounded-full font-medium">{{ $v->events_count }} events</span>
                            </li>
                        @empty
                            <li class="text-center py-8">
                                <div class="text-4xl mb-2">🏢</div>
                                <p class="text-neutral-500">No venues yet</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </section>

            <!-- Lower area: upcoming + recent attendees -->
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Upcoming Events -->
                <div class="lg:col-span-2 rounded-3xl bg-white/70 backdrop-blur-md border border-white/40 p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 dark:bg-neutral-900/60 dark:border-neutral-700/40">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-neutral-800 dark:text-neutral-100">Upcoming events 🎆</h3>
                            <p class="text-xs text-neutral-500">What's coming next</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        @forelse($upcomingEvents as $index => $e)
                            <div class="group p-4 rounded-2xl bg-gradient-to-r from-white/60 to-blue-50/60 dark:from-neutral-800/60 dark:to-blue-900/20 border border-white/40 hover:shadow-lg transition-all duration-300 hover:scale-105">
                                <div class="flex items-start gap-4">
                                    <!-- Date badge -->
                                    <div class="flex-shrink-0 text-center">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-400 to-purple-400 flex flex-col items-center justify-center text-white text-xs font-bold shadow-md">
                                            <div>{{ $e->scheduled_at->format('M') }}</div>
                                            <div class="text-lg leading-none">{{ $e->scheduled_at->format('d') }}</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Event info -->
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-neutral-800 dark:text-neutral-100 truncate mb-1">{{ $e->title }}</h4>
                                        <div class="text-sm text-neutral-600 dark:text-neutral-400 space-y-1">
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span>{{ $e->scheduled_at->format('g:i A') }}</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                <span class="truncate">{{ $e->venue->name ?? 'TBD' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Attendee count -->
                                    <div class="flex-shrink-0 text-center">
                                        <div class="bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 px-3 py-2 rounded-full text-sm font-medium">
                                            <div class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                </svg>
                                                <span>{{ $e->attendees_count }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div class="text-6xl mb-4">🗓️</div>
                                <p class="text-neutral-500 text-lg">No upcoming events</p>
                                <p class="text-neutral-400 text-sm">Create your first event to get started!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                
                <!-- Recent Attendees -->
                <div class="rounded-3xl bg-white/70 backdrop-blur-md border border-white/40 p-6 shadow-2xl hover:shadow-3xl transition-all duration-500 dark:bg-neutral-900/60 dark:border-neutral-700/40">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-green-500 to-teal-500 flex items-center justify-center text-white shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-neutral-800 dark:text-neutral-100">Recent attendees 👥</h3>
                            <p class="text-xs text-neutral-500">New registrations</p>
                        </div>
                    </div>
                    <ul class="space-y-3">
                        @forelse($recentAttendees as $index => $a)
                            <li class="group flex items-center gap-3 p-3 rounded-2xl bg-gradient-to-r from-white/60 to-green-50/60 dark:from-neutral-800/60 dark:to-green-900/20 border border-white/40 hover:shadow-md transition-all duration-300 hover:scale-105">
                                <!-- Avatar -->
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-400 to-teal-400 flex items-center justify-center text-white font-bold shadow-md">
                                    {{ strtoupper(substr($a->name, 0, 1)) }}
                                </div>
                                
                                <!-- Info -->
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-neutral-800 dark:text-neutral-100 truncate">{{ $a->name }}</p>
                                    <p class="text-xs text-neutral-500">{{ $a->created_at->diffForHumans() }}</p>
                                </div>
                                
                                <!-- Status indicator -->
                                <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse flex-shrink-0"></div>
                            </li>
                        @empty
                            <li class="text-center py-12">
                                <div class="text-4xl mb-4">👥</div>
                                <p class="text-neutral-500">No attendees yet</p>
                                <p class="text-neutral-400 text-sm">Start inviting people!</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </section>
        </div>
    </div>

    <!-- Charts with enhanced styling -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($chart['labels']);
        const values = @json($chart['series']);
        const ctx = document.getElementById('revenueChart');
        if (ctx) {
            // Create beautiful gradient
            const grad = ctx.getContext('2d').createLinearGradient(0, 0, 0, 200);
            grad.addColorStop(0, 'rgba(168, 85, 247, 0.4)');
            grad.addColorStop(0.4, 'rgba(236, 72, 153, 0.3)');
            grad.addColorStop(1, 'rgba(168, 85, 247, 0.05)');
            
            // Point gradient
            const pointGrad = ctx.getContext('2d').createLinearGradient(0, 0, 0, 200);
            pointGrad.addColorStop(0, '#a855f7');
            pointGrad.addColorStop(1, '#ec4899');
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Revenue',
                        data: values,
                        tension: 0.4,
                        borderColor: '#a855f7',
                        backgroundColor: grad,
                        fill: true,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#a855f7',
                        pointBorderWidth: 3,
                        pointHoverBackgroundColor: '#ec4899',
                        pointHoverBorderColor: '#ffffff',
                        borderWidth: 3,
                        borderCapStyle: 'round',
                        borderJoinStyle: 'round'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            borderColor: '#a855f7',
                            borderWidth: 1,
                            cornerRadius: 12,
                            displayColors: false,
                            callbacks: {
                                title: function(context) {
                                    return context[0].label;
                                },
                                label: function(context) {
                                    return 'Revenue: $' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: {
                                color: '#6b7280',
                                font: { size: 12 }
                            }
                        },
                        y: {
                            grid: {
                                color: 'rgba(148, 163, 184, 0.1)',
                                drawBorder: false
                            },
                            border: { display: false },
                            ticks: {
                                color: '#6b7280',
                                font: { size: 12 },
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    elements: {
                        point: {
                            hoverBorderWidth: 4
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutCubic'
                    }
                }
            });
        }
        
        // Add cute loading animations to all cards
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on load
            const cards = document.querySelectorAll('[class*="rounded-3xl"], [class*="rounded-2xl"]');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
            
            // Add floating animation to background elements
            const floatingElements = document.querySelectorAll('.animate-float');
            floatingElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.animation = 'float 2s ease-in-out infinite';
                });
            });
        });
    </script>
</x-layouts.dashboard>
