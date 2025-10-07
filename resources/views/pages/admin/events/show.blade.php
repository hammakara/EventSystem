<x-layouts.admin>
    <div class="w-full bg-gray-50 dark:bg-neutral-900 py-5 px-3">
        <div class="w-full max-w-6xl mx-auto bg-white dark:bg-neutral-900 border border-gray-100 dark:border-neutral-800 shadow-lg rounded-xl p-8">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $event->title }}</h1>
                <div class="flex items-center mt-2 space-x-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                        {{ ucfirst($event->status) }}
                    </span>
                    @if($event->category)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                            {{ $event->category->name }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Image -->
            @if($event->image)
                <div class="mb-6">
                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="w-full max-w-md mx-auto rounded-lg shadow-md object-cover">
                </div>
            @endif

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Description -->
                <div class="md:col-span-2">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-neutral-300 mb-2">Description</h2>
                    <p class="text-gray-600 dark:text-neutral-400">{{ $event->description ?? 'No description provided.' }}</p>
                </div>

                <!-- Dates -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-neutral-400 mb-1">Start Date</h3>
                    <p class="text-lg text-gray-900 dark:text-white">{{ $event->start_date->format('F j, Y') }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-neutral-400 mb-1">End Date</h3>
                    <p class="text-lg text-gray-900 dark:text-white">{{ $event->end_date->format('F j, Y') }}</p>
                </div>

                <!-- Location -->
                <div class="md:col-span-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-neutral-400 mb-1">Location</h3>
                    <p class="text-lg text-gray-900 dark:text-white">{{ $event->location ?? 'No location specified.' }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('events.edit', $event) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                    Edit
                </a>
                <form method="POST" action="{{ route('events.destroy', $event) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this event?')">
                        Delete
                    </button>
                </form>
                <a href="{{ route('events.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.admin>
