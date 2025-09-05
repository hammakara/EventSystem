<x-layouts.dashboard title="Vendors">
    <div class="p-6 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">Vendors</h1>
            <a href="{{ route('vendors.create') }}" class="px-3 py-2 rounded-xl bg-gradient-to-r from-fuchsia-600 to-indigo-600 text-white">New Vendor</a>
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
                        <th class="text-left px-4 py-2">Contact</th>
                        <th class="text-left px-4 py-2">Fee</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendors as $v)
                        <tr class="border-t border-violet-100 dark:border-neutral-800">
                            <td class="px-4 py-2">
                                @php($src = $v->image ? (Str::startsWith($v->image,'http') ? $v->image : asset('storage/'.$v->image)) : null)
                                <img src="{{ $src }}" class="w-12 h-12 rounded-lg object-cover" />
                            </td>
                            <td class="px-4 py-2">{{ $v->name }}</td>
                            <td class="px-4 py-2">{{ $v->contact }}</td>
                            <td class="px-4 py-2">${{ number_format($v->fee,2) }}</td>
                            <td class="px-4 py-2 text-right">
                                <a class="text-indigo-600" href="{{ route('vendors.edit',$v) }}">Edit</a>
                                <form action="{{ route('vendors.destroy',$v) }}" method="POST" class="inline" onsubmit="return confirm('Delete vendor?')">
                                    @csrf @method('DELETE')
                                    <button class="ml-2 text-rose-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $vendors->links() }}
    </div>
</x-layouts.dashboard>

