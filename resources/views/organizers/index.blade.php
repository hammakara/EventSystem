<x-layouts.dashboard title="Organizers">
    <div class="p-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Organizers</h1>
            <a href="{{ route('organizers.create') }}" class="px-3 py-2 rounded-xl bg-gradient-to-r from-fuchsia-600 to-indigo-600 text-white">New Organizer</a>
        </div>
        @if(session('status'))
            <div class="p-3 rounded-xl bg-emerald-50 text-emerald-700">{{ session('status') }}</div>
        @endif
        <div class="rounded-2xl border border-violet-100 bg-white/80 dark:bg-neutral-900/70 dark:border-neutral-800 overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-violet-50/60 dark:bg-neutral-800">
                    <tr>
                        <th class="text-left px-4 py-2">Image</th>
                        <th class="text-left px-4 py-2">Name</th>
                        <th class="text-left px-4 py-2">Email</th>
                        <th class="text-left px-4 py-2">Role</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizers as $o)
                        <tr class="border-t border-violet-100 dark:border-neutral-800">
                            <td class="px-4 py-2">
                                @php($src = $o->image ? (Str::startsWith($o->image,'http') ? $o->image : asset('storage/'.$o->image)) : null)
                                <img src="{{ $src }}" class="w-12 h-12 rounded-lg object-cover" />
                            </td>
                            <td class="px-4 py-2">{{ $o->name }}</td>
                            <td class="px-4 py-2">{{ $o->email }}</td>
                            <td class="px-4 py-2">{{ $o->role }}</td>
                            <td class="px-4 py-2 text-right">
                                <a class="text-indigo-600" href="{{ route('organizers.edit',$o) }}">Edit</a>
                                <form action="{{ route('organizers.destroy',$o) }}" method="POST" class="inline" onsubmit="return confirm('Delete organizer?')">
                                    @csrf @method('DELETE')
                                    <button class="ml-2 text-rose-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $organizers->links() }}
    </div>
</x-layouts.dashboard>

