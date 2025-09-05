<x-layouts.dashboard title="Create event">
    <div class="p-6 max-w-2xl">
        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-4" x-data="{ preview: null }">
            @csrf
            <div>
                <label class="form-label">Title</label>
                <input name="title" value="{{ old('title') }}" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Type</label>
                <input name="type" value="{{ old('type') }}" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Scheduled at</label>
                <input name="scheduled_at" type="datetime-local" value="{{ old('scheduled_at') }}" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Organizer</label>
                <select name="organizer_id" class="form-select" required>
                    <option value="">Select organizer</option>
                    @foreach($organizers as $o)
                        <option value="{{ $o->id }}" @selected(old('organizer_id')==$o->id)>{{ $o->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Venue</label>
                <select name="venue_id" class="form-select" required>
                    <option value="">Select venue</option>
                    @foreach($venues as $v)
                        <option value="{{ $v->id }}" @selected(old('venue_id')==$v->id)>{{ $v->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm">Cover image</label>
                <div class="mt-1 grid grid-cols-1 gap-3 sm:grid-cols-2 items-start">
                    <div class="aspect-video rounded-xl bg-neutral-100 dark:bg-neutral-800 overflow-hidden flex items-center justify-center">
                        <img x-show="preview" :src="preview" class="w-full h-full object-cover" alt="Preview"/>
                        <div x-show="!preview" class="text-neutral-400 text-sm">No image</div>
                    </div>
                    <label class="rounded-xl border border-dashed border-violet-200 dark:border-neutral-700 p-4 cursor-pointer bg-white dark:bg-neutral-900 hover:bg-violet-50/50">
                        <input type="file" name="image" accept="image/*" class="hidden" @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                        <div class="text-sm text-neutral-600 dark:text-neutral-300">Click to upload</div>
                        <div class="text-xs text-neutral-400">PNG, JPG up to 2MB</div>
                    </label>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('events.index') }}" class="px-3 py-2 rounded-xl border">Cancel</a>
                <button class="px-3 py-2 rounded-xl bg-gradient-to-r from-fuchsia-600 to-indigo-600 text-white">Save</button>
            </div>
        </form>
    </div>
</x-layouts.dashboard>

