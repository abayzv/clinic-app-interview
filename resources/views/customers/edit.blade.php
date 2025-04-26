<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Customers ') . $customer->name }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Update current customer item.') }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('customers.update', $customer) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div>
                            <x-input-label for="name" :value="__(' Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $customer->name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="phone" :value="__(' Phone')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                                :value="old('phone', $customer->phone)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div>
                            <x-input-label for="address" :value="__(' Address')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address', $customer->address)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
