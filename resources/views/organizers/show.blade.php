<x-layouts.dashboard title="Organizer">
    <div class="p-6 max-w-2xl space-y-2">
        @if($organizer->image)
            @php($src = Str::startsWith($organizer->image,'http') ? $organizer->image : asset('storage/'.$organizer->image))
            <img src="{{ $src }}" class="w-32 h-32 rounded-xl object-cover" />
        @endif
        <p><span class="text-neutral-500">Name:</span> {{ $organizer->name }}</p>
        <p><span class="text-neutral-500">Email:</span> {{ $organizer->email }}</p>
        <p><span class="text-neutral-500">Address:</span> {{ $organizer->address }}</p>
        <p><span class="text-neutral-500">Role:</span> {{ $organizer->role }}</p>
        <a href="{{ route('organizers.index') }}" class="inline-block mt-3 px-3 py-2 rounded-xl border">Back</a>
    </div>
</x-layouts.dashboard>

