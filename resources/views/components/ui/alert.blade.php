@props(['type' => 'info', 'title' => null])
@php
  $colors = [
    'success' => 'text-emerald-800 bg-emerald-50 border-emerald-200 dark:text-emerald-200 dark:bg-emerald-900/40 dark:border-emerald-800',
    'error' => 'text-rose-800 bg-rose-50 border-rose-200 dark:text-rose-200 dark:bg-rose-900/40 dark:border-rose-800',
    'warning' => 'text-amber-800 bg-amber-50 border-amber-200 dark:text-amber-200 dark:bg-amber-900/40 dark:border-amber-800',
    'info' => 'text-indigo-800 bg-indigo-50 border-indigo-200 dark:text-indigo-200 dark:bg-indigo-900/40 dark:border-indigo-800',
  ][$type] ?? $colors['info'];
@endphp
<div {{ $attributes->merge(['class' => "rounded-xl border px-3 py-2 text-sm $colors"]) }}>
  @if($title)
    <div class="font-semibold">{{ $title }}</div>
  @endif
  <div>{{ $slot }}</div>
</div>
