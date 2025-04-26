<div class="space-y-6">
    <!-- Invoice number -->
    <div class="flex flex-col items-start">
        <x-input-label for="invoice_number" :value="__(' Invoice number')" />
        <x-text-input id="invoice_number" name="invoice_number" type="text" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('invoice_number')" />
    </div>

    <!-- Customer id -->
    <div class="flex flex-col items-start">
        <x-input-label for="customer_id" :value="__(' Customer')" />
        <x-select id="customer_id" name="customer_id" class="mt-1 block w-full" required>
            <option value="">Select a Customer</option>
            @foreach ($customers as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </x-select>
        <x-input-error class="mt-2" :messages="$errors->get('customer_id')" />
    </div>

    <!-- Discount -->
    <div class="flex flex-col items-start">
        <x-input-label for="discount" :value="__(' Discount')" />
        <x-text-input id="discount" name="discount" type="number" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('discount')" />
    </div>

    <!-- Total price -->
    <div class="flex flex-col items-start">
        <x-input-label for="total_price" :value="__(' Total price')" />
        <x-text-input id="total_price" name="total_price" type="number" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('total_price')" />
    </div>
</div>
