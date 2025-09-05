<x-guest-layout>
    <div class="mb-4 text-sm text-neutral-600 dark:text-neutral-400">
        {{ __('Thanks for signing up! Please verify your email via the link we sent. Didn\'t get it?') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-emerald-600 dark:text-emerald-400">
            {{ __('A new verification link has been sent to your email address.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>{{ __('Resend Verification Email') }}</x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-neutral-600 dark:text-neutral-400 hover:text-neutral-900">{{ __('Log Out') }}</button>
        </form>
    </div>
</x-guest-layout>
