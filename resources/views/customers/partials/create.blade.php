<div class="space-y-6">
    <!-- Name -->
    <div class="flex flex-col items-start">
        <x-input-label for="name" :value="__(' Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <!-- Phone -->
    <div class="flex flex-col items-start">
        <x-input-label for="phone" :value="__(' Phone')" />
        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
    </div>

    <!-- Address -->
    <div class="flex flex-col items-start">
        <x-input-label for="address" :value="__(' Address')" />
        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('address')" />
    </div>
</div>
