<x-guest-layout>
    <div class="mb-4 text-sm text-neutral-600 dark:text-neutral-400">
        {{ __('This is a secure area. Confirm your password to continue.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <x-primary-button class="w-full">{{ __('Confirm') }}</x-primary-button>
    </form>
</x-guest-layout>
