<x-layouts.dashboard title="System Analytics">
    <div class="px-4 py-6 space-y-6">
        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-neutral-900 dark:text-white bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                    System Analytics
                </h1>
                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                    Comprehensive reports and insights
                </p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-flex items-center px-3 py-2 bg-neutral-600 hover:bg-neutral-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>

        <!-- Analytics Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Growth -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">User Growth (Last 12 Months)</h2>
                <div class="space-y-2">
                    @foreach($analytics['user_growth'] as $data)
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-neutral-600 dark:text-neutral-400">{{ $data['month'] }}</span>
                            <span class="text-sm font-medium text-neutral-900 dark:text-white">{{ $data['users'] }} users</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Event Statistics -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Event Status</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <span class="text-sm font-medium text-green-800 dark:text-green-300">Upcoming Events</span>
                        <span class="text-lg font-bold text-green-900 dark:text-green-200">{{ $analytics['event_statistics']['by_status']['upcoming'] }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <span class="text-sm font-medium text-blue-800 dark:text-blue-300">Ongoing Events</span>
                        <span class="text-lg font-bold text-blue-900 dark:text-blue-200">{{ $analytics['event_statistics']['by_status']['ongoing'] }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-neutral-50 dark:bg-neutral-700/20 rounded-lg">
                        <span class="text-sm font-medium text-neutral-800 dark:text-neutral-300">Completed Events</span>
                        <span class="text-lg font-bold text-neutral-900 dark:text-neutral-200">{{ $analytics['event_statistics']['by_status']['completed'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Popular Venues -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Popular Venues</h2>
                <div class="space-y-3">
                    @forelse($analytics['popular_venues'] as $venue)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-neutral-900 dark:text-white">{{ $venue->name }}</p>
                                <p class="text-xs text-neutral-600 dark:text-neutral-400">{{ Str::limit($venue->address ?? '', 30) }}</p>
                            </div>
                            <span class="text-sm font-semibold text-purple-600 dark:text-purple-400">{{ $venue->events_count }} events</span>
                        </div>
                    @empty
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">No venue data available</p>
                    @endforelse
                </div>
            </div>

            <!-- Top Organizers -->
            <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Top Organizers</h2>
                <div class="space-y-3">
                    @forelse($analytics['organizer_performance'] as $organizer)
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-neutral-900 dark:text-white">{{ $organizer->name }}</p>
                                <p class="text-xs text-neutral-600 dark:text-neutral-400">{{ $organizer->email }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-blue-600 dark:text-blue-400">{{ $organizer->events_count }} total</p>
                                <p class="text-xs text-green-600 dark:text-green-400">{{ $organizer->upcoming_events }} upcoming</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">No organizer data available</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Attendee Engagement -->
        <div class="bg-white dark:bg-neutral-800 rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
            <h2 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Attendee Engagement</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ number_format($analytics['attendee_engagement']['total_registrations']) }}</p>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Total Registrations</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ number_format($analytics['attendee_engagement']['avg_events_per_attendee'] ?? 0, 1) }}</p>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Avg Events per Attendee</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $analytics['attendee_engagement']['most_active_attendees']->count() }}</p>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400">Active Attendees</p>
                </div>
            </div>

            @if($analytics['attendee_engagement']['most_active_attendees']->count() > 0)
                <div class="mt-6">
                    <h3 class="text-md font-medium text-neutral-900 dark:text-white mb-3">Most Active Attendees</h3>
                    <div class="space-y-2">
                        @foreach($analytics['attendee_engagement']['most_active_attendees']->take(5) as $attendee)
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-neutral-900 dark:text-white">{{ $attendee->name }}</span>
                                <span class="text-sm font-medium text-purple-600 dark:text-purple-400">{{ $attendee->events_count }} events</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.dashboard>
