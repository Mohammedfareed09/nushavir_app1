<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Enter Your Phone Number') }}
    </div>

    <form method="POST" action="{{ route('verify-phone.store') }}">
        @csrf

        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />

            <x-text-input id="phone" class="block mt-1 w-full"
                            type="text"
                            name="phone"
                            required />

            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
