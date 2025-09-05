<x-layouts.dashboard title="Venue">
    <div class="p-6 max-w-2xl space-y-2">
        @if($venue->image)
            @php($src = Str::startsWith($venue->image,'http') ? $venue->image : asset('storage/'.$venue->image))
            <img src="{{ $src }}" class="w-full h-56 rounded-xl object-cover" />
        @endif
        <p><span class="text-neutral-500">Name:</span> {{ $venue->name }}</p>
        <p><span class="text-neutral-500">Address:</span> {{ $venue->address }}</p>
        <p><span class="text-neutral-500">Contact:</span> {{ $venue->contact }}</p>
        <p><span class="text-neutral-500">Owner:</span> {{ $venue->owner }}</p>
        <a href="{{ route('venues.index') }}" class="inline-block mt-3 px-3 py-2 rounded-xl border">Back</a>
    </div>
</x-layouts.dashboard>

