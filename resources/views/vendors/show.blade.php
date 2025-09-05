<x-layouts.dashboard title="Vendor">
    <div class="p-6 max-w-2xl space-y-2">
        @if($vendor->image)
            @php($src = Str::startsWith($vendor->image,'http') ? $vendor->image : asset('storage/'.$vendor->image))
            <img src="{{ $src }}" class="w-48 h-36 rounded-xl object-cover" />
        @endif
        <p><span class="text-neutral-500">Name:</span> {{ $vendor->name }}</p>
        <p><span class="text-neutral-500">Contact:</span> {{ $vendor->contact }}</p>
        <p><span class="text-neutral-500">Fee:</span> ${{ number_format($vendor->fee,2) }}</p>
        <p><span class="text-neutral-500">Details:</span> {{ $vendor->details }}</p>
        <a href="{{ route('vendors.index') }}" class="inline-block mt-3 px-3 py-2 rounded-xl border">Back</a>
    </div>
</x-layouts.dashboard>

