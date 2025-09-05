<x-layouts.dashboard title="Attendees">
    <div class="p-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Attendees</h1>
            <a href="{{ route('attendees.create') }}" class="px-3 py-2 rounded-xl bg-gradient-to-r from-fuchsia-600 to-indigo-600 text-white">New Attendee</a>
        </div>
        @if(session('status'))
            <div class="p-3 rounded-xl bg-emerald-50 text-emerald-700">{{ session('status') }}</div>
        @endif
        <div class="rounded-2xl border border-violet-100 bg-white/80 dark:bg-neutral-900/70 dark:border-neutral-800 overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-violet-50/60 dark:bg-neutral-800">
                    <tr>
                        <th class="text-left px-4 py-2">Avatar</th>
                        <th class="text-left px-4 py-2">Name</th>
                        <th class="text-left px-4 py-2">Contact</th>
                        <th class="text-left px-4 py-2">Status</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendees as $a)
                        <tr class="border-t border-violet-100 dark:border-neutral-800">
                            <td class="px-4 py-2">
                                @php($src = $a->image ? (Str::startsWith($a->image,'http') ? $a->image : asset('storage/'.$a->image)) : null)
                                <img src="{{ $src }}" class="w-10 h-10 rounded-lg object-cover" />
                            </td>
                            <td class="px-4 py-2">{{ $a->name }}</td>
                            <td class="px-4 py-2">{{ $a->contact }}</td>
                            <td class="px-4 py-2">{{ $a->status }}</td>
                            <td class="px-4 py-2 text-right">
                                <a class="text-indigo-600" href="{{ route('attendees.edit',$a) }}">Edit</a>
                                <form action="{{ route('attendees.destroy',$a) }}" method="POST" class="inline" onsubmit="return confirm('Delete attendee?')">
                                    @csrf @method('DELETE')
                                    <button class="ml-2 text-rose-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $attendees->links() }}
    </div>
</x-layouts.dashboard>

