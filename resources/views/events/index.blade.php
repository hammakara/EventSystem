<x-layouts.dashboard title="Events">
    <div class="p-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Events</h1>
            <a href="{{ route('events.create') }}" class="px-3 py-2 rounded-xl bg-gradient-to-r from-fuchsia-600 to-indigo-600 text-white">New Event</a>
        </div>
        @if(session('status'))
            <div class="p-3 rounded-xl bg-emerald-50 text-emerald-700">{{ session('status') }}</div>
        @endif
        <div class="rounded-2xl border border-violet-100 bg-white/80 dark:bg-neutral-900/70 dark:border-neutral-800 overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-violet-50/60 dark:bg-neutral-800">
                    <tr>
                        <th class="text-left px-4 py-2">Image</th>
                        <th class="text-left px-4 py-2">Title</th>
                        <th class="text-left px-4 py-2">Type</th>
                        <th class="text-left px-4 py-2">Scheduled</th>
                        <th class="text-left px-4 py-2">Organizer</th>
                        <th class="text-left px-4 py-2">Venue</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $e)
                        <tr class="border-t border-violet-100 dark:border-neutral-800">
                            <td class="px-4 py-2">
                                @php($src = $e->image ? (Str::startsWith($e->image,'http') ? $e->image : asset('storage/'.$e->image)) : null)
                                <img src="{{ $src }}" class="w-12 h-12 rounded-lg object-cover" alt="" />
                            </td>
                            <td class="px-4 py-2">{{ $e->title }}</td>
                            <td class="px-4 py-2">{{ $e->type }}</td>
                            <td class="px-4 py-2">{{ $e->scheduled_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-2">{{ $e->organizer->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $e->venue->name ?? '-' }}</td>
                            <td class="px-4 py-2 text-right">
                                <a class="text-indigo-600" href="{{ route('events.show',$e) }}">View</a>
                                <a class="ml-2 text-indigo-600" href="{{ route('events.edit',$e) }}">Edit</a>
                                <form action="{{ route('events.destroy',$e) }}" method="POST" class="inline" onsubmit="return confirm('Delete event?')">
                                    @csrf @method('DELETE')
                                    <button class="ml-2 text-rose-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $events->links() }}
    </div>
</x-layouts.dashboard>

