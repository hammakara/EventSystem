@extends('components.layouts.dashboard')

@section('title', 'Event Details - ' . $event->title)
@section('header-title', 'Event Details')
@section('header-subtitle', 'View event information')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Event Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg mb-8">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h1>
                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $event->category->name }}
                            </div>
                        </div>
                        <div>
                            @if ($event->status === 'active')
                                <span
                                    class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                            @elseif($event->status === 'cancelled')
                                <span
                                    class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                            @else
                                <span
                                    class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Completed</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6">
                        @if ($event->image)
                            <img src="{{ $event->image_url }}" alt="{{ $event->title }}"
                                class="w-full h-96 object-cover rounded-xl shadow-lg">
                        @else
                            <div
                                class="w-full h-96 bg-gradient-to-r from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Event Description -->
            <div class="bg-white rounded-2xl shadow-lg">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Description</h2>
                    <div class="prose max-w-none text-gray-600">
                        {!! nl2br(e($event->description ?? 'No description provided.')) !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar -->
        <div class="space-y-8">
            <!-- Event Info -->
            <div class="bg-white rounded-2xl shadow-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Event Information</h2>
                    <div class="space-y-4">
                        <div class="flex items-center text-gray-500">
                            <div class="flex-shrink-0 mr-3 h-8 w-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Date & Time</span>
                        </div>
                        <div class="ml-11">
                            <div class="text-lg font-medium text-gray-900">
                                {{ $event->start_date instanceof \Illuminate\Support\Carbon ? $event->start_date->format('F d, Y') : date('F d, Y', strtotime($event->start_date)) }}
                            </div>
                            <div class="text-gray-500">
                                {{ $event->start_date instanceof \Illuminate\Support\Carbon ? $event->start_date->format('h:i A') : date('h:i A', strtotime($event->start_date)) }}
                                -
                                {{ $event->end_date instanceof \Illuminate\Support\Carbon ? $event->end_date->format('h:i A') : date('h:i A', strtotime($event->end_date)) }}
                            </div>
                        </div>

                        <div class="flex items-center text-gray-500">
                            <div
                                class="flex-shrink-0 mr-3 h-8 w-8 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Location</span>
                        </div>
                        <div class="ml-11">
                            <div class="text-lg font-medium text-gray-900">{{ $event->location ?? 'Not specified' }}</div>
                        </div>

                        <div class="flex items-center text-gray-500">
                            <div
                                class="flex-shrink-0 mr-3 h-8 w-8 rounded-lg bg-purple-100 flex items-center justify-center">
                                <svg class="h-5 w-5 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium">Category</span>
                        </div>
                        <div class="ml-11">
                            <div class="text-lg font-medium text-gray-900">{{ $event->category->name }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-2xl shadow-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Actions</h2>
                    <div class="space-y-3">
                        <a href="{{ route('events.index') }}"
                            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                            Back to Events
                        </a>
                        <a href="{{ route('events.edit', $event) }}"
                            class="w-full inline-flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                            Edit Event
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
