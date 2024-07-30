<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('2-Step Verification') }}
    </div>

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf


        <div>
            <x-input-label for="password" :value="__('Verify Code')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="text"
                            name="otp"
                            required />

            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
