<x-layouts.dashboard title="Event details">
    <div class="p-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">{{ $event->title }}</h1>
            <a href="{{ route('events.edit',$event) }}" class="px-3 py-2 rounded-xl bg-gradient-to-r from-fuchsia-600 to-indigo-600 text-white">Edit</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2 rounded-2xl border border-violet-100 bg-white/80 dark:bg-neutral-900/70 dark:border-neutral-800 p-4">
                @if($event->image)
                    @php($src = Str::startsWith($event->image,'http') ? $event->image : asset('storage/'.$event->image))
                    <img src="{{ $src }}" class="w-full h-64 rounded-xl object-cover" />
                @endif
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm mt-3">
                    <div><dt class="text-neutral-500">Type</dt><dd class="font-medium">{{ $event->type }}</dd></div>
                    <div><dt class="text-neutral-500">Scheduled</dt><dd class="font-medium">{{ $event->scheduled_at->format('Y-m-d H:i') }}</dd></div>
                    <div><dt class="text-neutral-500">Organizer</dt><dd class="font-medium">{{ $event->organizer->name }}</dd></div>
                    <div><dt class="text-neutral-500">Venue</dt><dd class="font-medium">{{ $event->venue->name }}</dd></div>
                </dl>
            </div>
            <div class="rounded-2xl border border-violet-100 bg-white/80 dark:bg-neutral-900/70 dark:border-neutral-800 p-4">
                <p class="font-semibold">Vendors</p>
                <ul class="mt-2 space-y-1 text-sm">
                    @foreach($event->vendors as $v)
                        <li class="flex items-center justify-between">
                            <span>{{ $v->name }}</span>
                            <span class="text-neutral-500">${{ number_format($v->pivot->fee ?? $v->fee, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="rounded-2xl border border-violet-100 bg-white/80 dark:bg-neutral-900/70 dark:border-neutral-800 p-4">
            <p class="font-semibold">Attendees ({{ $event->attendees->count() }})</p>
            <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 text-sm">
                @foreach($event->attendees as $a)
                    <div class="rounded-xl border border-violet-100 dark:border-neutral-800 p-3 bg-white/70 dark:bg-neutral-900/60">
                        <p class="font-medium">{{ $a->name }}</p>
                        <p class="text-neutral-500">{{ $a->contact }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.dashboard>

