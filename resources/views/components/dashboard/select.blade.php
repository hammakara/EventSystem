@props(['label' => null, 'options' => [], 'model' => null])
<label class="inline-flex items-center gap-2 text-sm">
    @if($label)
        <span class="text-neutral-500">{{ $label }}</span>
    @endif
    <select x-model="{{ $model }}" class="px-3 py-2 rounded-xl border bg-white border-violet-100 dark:bg-neutral-900 dark:border-neutral-800">
        @foreach ($options as $opt)
            <option value="{{ $opt }}">{{ $opt }}</option>
        @endforeach
    </select>
</label>
