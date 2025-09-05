<div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300>
  @if (session('status'))
    <x-ui.alert type="success" class="mb-3">
      {{ session('status') }}
    </x-ui.alert>
  @endif
  @if (session('error'))
    <x-ui.alert type="error" class="mb-3">
      {{ session('error') }}
    </x-ui.alert>
  @endif
  @if ($errors->any())
    <x-ui.alert type="error" class="mb-3">
      {{ $errors->first() }}
    </x-ui.alert>
  @endif
</div>
