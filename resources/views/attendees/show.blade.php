<x-layouts.dashboard title="Attendee">
    <div class="p-6 max-w-2xl space-y-2">
        @if($attendee->image)
            @php($src = Str::startsWith($attendee->image,'http') ? $attendee->image : asset('storage/'.$attendee->image))
            <img src="{{ $src }}" class="w-24 h-24 rounded-xl object-cover" />
        @endif
        <p><span class="text-neutral-500">Name:</span> {{ $attendee->name }}</p>
        <p><span class="text-neutral-500">Contact:</span> {{ $attendee->contact }}</p>
        <p><span class="text-neutral-500">Status:</span> {{ $attendee->status }}</p>
        <p><span class="text-neutral-500">Preferences:</span> {{ json_encode($attendee->preferences) }}</p>
        <a href="{{ route('attendees.index') }}" class="inline-block mt-3 px-3 py-2 rounded-xl border">Back</a>
    </div>
</x-layouts.dashboard>

