<x-layouts.dashboard title="Create vendor">
    <div class="p-6 max-w-2xl">
        <form method="POST" action="{{ route('vendors.store') }}" enctype="multipart/form-data" class="space-y-4" x-data="{ preview:null }">
            @csrf
            <div>
                <label class="form-label">Name</label>
                <input name="name" value="{{ old('name') }}" class="form-control" required>
            </div>
            <div>
                <label class="form-label">Contact</label>
                <input name="contact" value="{{ old('contact') }}" class="form-control">
            </div>
            <div>
                <label class="form-label">Fee</label>
                <input name="fee" type="number" step="0.01" value="{{ old('fee') }}" class="form-control">
            </div>
            <div>
                <label class="form-label">Details</label>
                <textarea name="details" class="form-textarea">{{ old('details') }}</textarea>
            </div>
            <div>
                <label class="text-sm">Image</label>
                <div class="mt-1 grid grid-cols-1 gap-3 sm:grid-cols-2 items-start">
                    <div class="aspect-video rounded-xl bg-neutral-100 dark:bg-neutral-800 overflow-hidden flex items-center justify-center">
                        <img x-show="preview" :src="preview" class="w-full h-full object-cover"/>
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
                <a href="{{ route('vendors.index') }}" class="px-3 py-2 rounded-xl border">Cancel</a>
                <button class="px-3 py-2 rounded-xl bg-gradient-to-r from-fuchsia-600 to-indigo-600 text-white">Save</button>
            </div>
        </form>
    </div>
</x-layouts.dashboard>

