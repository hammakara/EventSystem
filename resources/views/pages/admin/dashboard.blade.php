<x-layouts.admin>
    <div class="space-y-6">
        <!-- Page Title -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                <p class="mt-1 text-gray-600 dark:text-gray-400">Welcome back, {{ auth()->user()->name }}! Here's what's happening today.</p>
            </div>
            <div class="mt-4 md:mt-0">
                <button type="button" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                        <path d="M3 3v5h5" />
                        <path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16" />
                        <path d="M16 16h5v5" />
                    </svg>
                    Refresh
                </button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Events -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Total Events
                        </p>
                        <div class="hs-tooltip">
                            <div class="hs-tooltip-toggle">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                    <path d="M12 17h.01" />
                                </svg>
                                <div class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity hidden invisible w-40 bg-gray-900 text-xs text-white py-1 px-2 rounded shadow-sm dark:bg-gray-700" role="tooltip">
                                    Number of events in the system
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-gray-200">
                            {{ $totalEvents }}
                        </h3>
                        
                    </div>
                </div>
            </div>
            <!-- End Total Events -->

            <!-- Active Events -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Active Events
                        </p>
                    </div>

                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-gray-200">
                            {{ $activeEvents }}
                        </h3>
                       
                    </div>
                </div>
            </div>
            <!-- End Active Events -->

            <!-- Upcoming Events -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Upcoming Events
                        </p>
                    </div>

                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-gray-200">
                            {{ $upcomingEvents }}
                        </h3>
                      
                    </div>
                </div>
            </div>
            <!-- End Upcoming Events -->

            <!-- Revenue -->
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">
                            Revenue
                        </p>
                    </div>

                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl sm:text-2xl font-medium text-gray-800 dark:text-gray-200">
                            ${{ number_format($revenue) }}
                        </h3>
                      
                    </div>
                </div>
            </div>
            <!-- End Revenue -->
        </div>
        <!-- End Stats Grid -->


        <!-- Recent Events Table -->
        <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
                            <!-- Header -->
                            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                                <!-- Input -->
                                <div class="sm:col-span-1">
                                    <label for="hs-as-table-product-review-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <input type="text" id="hs-as-table-product-review-search" name="hs-as-table-product-review-search" class="py-2 px-3 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Search">
                                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                                            <svg class="shrink-0 size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="11" cy="11" r="8" />
                                                <path d="m21 21-4.3-4.3" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Input -->

                                <div class="sm:col-span-2 md:grow">
                                    <div class="flex justify-end gap-x-2">
                                        <div class="hs-dropdown [--placement:bottom-right] relative inline-block">
                                            <a id="hs-as-table-table-export-dropdown" href="{{ route('events.create') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" size-4">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>

                                                Add Event
                                            </a>
                                           
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->

                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-gray-50 dark:bg-neutral-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                    Event
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                    Category
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                    Date
                                                </span>
                                            </div>
                                        </th>

                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                    Status
                                                </span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @forelse($recentEvents as $event)
                                    <tr class="bg-white hover:bg-gray-50 dark:bg-neutral-900 dark:hover:bg-neutral-800">
                                        <td class="size-px whitespace-nowrap align-top">
                                            <a class="block p-6" href="{{ route('events.show', $event) }}">
                                                <div class="flex items-center gap-x-4">
                                                    @if($event->image)
                                                    <img class="shrink-0 size-9.5 rounded-lg" src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                                                    @else
                                                    <span class="inline-flex items-center justify-center size-9.5 rounded-lg bg-gray-300 dark:bg-neutral-700">
                                                        <span class="font-medium text-gray-800 dark:text-neutral-200">{{ substr($event->title, 0, 1) }}</span>
                                                    </span>
                                                    @endif
                                                    <div>
                                                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $event->title }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="size-px whitespace-nowrap align-top">
                                            <a class="block p-6" href="{{ route('events.show', $event) }}">
                                                <div class="flex items-center gap-x-3">
                                                    <div class="grow">
                                                        <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $event->category->name }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="size-px whitespace-nowrap align-top">
                                            <a class="block p-6" href="{{ route('events.show', $event) }}">
                                                <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $event->start_date->format('M d, Y') }}</span>
                                            </a>
                                        </td>
                                        <td class="size-px whitespace-nowrap align-top">
                                            <a class="block p-6" href="{{ route('events.show', $event) }}">
                                                <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium 
                                                    @if($event->status === 'active') bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500
                                                    @elseif($event->status === 'cancelled') bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500
                                                    @else bg-blue-100 text-blue-800 rounded-full dark:bg-blue-500/10 dark:text-blue-500 @endif">
                                                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                        @if($event->status === 'active')
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                                        @elseif($event->status === 'cancelled')
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                        @else
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                                        @endif
                                                    </svg>
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="bg-white hover:bg-gray-50 dark:bg-neutral-900 dark:hover:bg-neutral-800">
                                        <td colspan="4" class="text-center py-5">
                                            <div class="text-center">
                                                <svg class="mx-auto size-12 text-gray-300 dark:text-gray-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                    <circle cx="9" cy="7" r="4" />
                                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                </svg>
                                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                    No events found
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table -->

                            <!-- End Footer -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Recent Events Table -->
    </div>
</x-layouts.admin>