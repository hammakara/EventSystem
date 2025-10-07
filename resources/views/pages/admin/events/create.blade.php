<x-layouts.admin>
    <div class="max-w-6xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
            <!-- Header -->
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Create Event
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        Add a new event to your event management system
                    </p>
                </div>

                <div>
                    <div class="inline-flex gap-x-2">
                        <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" href="{{ route('events.index') }}">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m15 18-6-6 6-6" />
                            </svg>
                            Back to events
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Header -->

            <form method="post" action="{{ route('events.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-6">
                    <!-- Event Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="md:col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Event Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Enter event title"
                                class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required
                            />
                            @error('title')
                            <span class="text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Description</label>
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="Write a brief event description"
                                class="py-3 px-4 block w-full border  border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            >{{ old('description') }}</textarea>
                            @error('description')
                            <span class="text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="start_date" class="block mb-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Start Date</label>
                            <input
                                type="date"
                                id="start_date"
                                name="start_date"
                                value="{{ old('start_date') }}"
                                class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required
                            />
                            @error('start_date')
                            <span class="text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block mb-2 text-sm font-medium text-gray-700 dark:text-neutral-300">End Date</label>
                            <input
                                type="date"
                                id="end_date"
                                name="end_date"
                                value="{{ old('end_date') }}"
                                class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required
                            />
                            @error('end_date')
                            <span class="text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Location</label>
                            <input
                                type="text"
                                id="location"
                                name="location"
                                value="{{ old('location') }}"
                                placeholder="Enter event location"
                                class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            />
                            @error('location')
                            <span class="text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Category</label>
                            <select
                                name="category_id"
                                id="category_id"
                                class="py-3 px-4 pe-9 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                required
                            >
                                <option value="" disabled selected>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Status</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="flex items-center">
                                    <input
                                        type="radio"
                                        name="status"
                                        value="active"
                                        class="shrink-0 mt-1 border border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                        {{ old('status') == 'active' ? 'checked' : '' }}
                                        required
                                    >
                                    <span class="ms-3 text-sm text-gray-700 dark:text-neutral-300">Active</span>
                                </label>

                                <label class="flex items-center">
                                    <input
                                        type="radio"
                                        name="status"
                                        value="inactive"
                                        class="shrink-0 mt-1 border border-gray-300 rounded-full text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                        {{ old('status') == 'inactive' ? 'checked' : '' }}
                                    >
                                    <span class="ms-3 text-sm text-gray-700 dark:text-neutral-300">Inactive</span>
                                </label>
                            </div>
                            @error('status')
                            <span class="text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="md:col-span-2">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-700 dark:text-neutral-300">Event Image</label>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/*"
                                class="block w-full text-sm border border-gray-200 rounded-lg shadow-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 file:me-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/30 dark:file:text-blue-400"
                            />
                            @error('image')
                            <span class="text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="image-preview" class="mt-3 hidden">
                                <img id="preview-img" src="" alt="Image Preview" class="w-32 h-32 object-cover rounded-lg border border-gray-200 dark:border-neutral-700">
                                <p class="text-xs text-gray-500 dark:text-neutral-400 mt-1">Preview of selected image</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Event Details -->
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-neutral-400">
                            Fields marked with <span class="text-red-500">*</span> are required
                        </p>
                    </div>

                    <div class="flex justify-end gap-x-2">
                        <a href="{{ route('events.index') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                            Cancel
                        </a>
                        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Create Event
                        </button>
                    </div>
                </div>
                <!-- End Footer -->
            </form>
        </div>
        <!-- End Card -->
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            const img = document.getElementById('preview-img');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });
    </script>
</x-layouts.admin>