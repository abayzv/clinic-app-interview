<div class="space-y-6">
    <!-- Name Field -->
    <div class="flex flex-col items-start">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
            autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <!-- SKU Field -->
    <div class="flex flex-col items-start">
        <x-input-label for="sku" :value="__('SKU')" />
        <x-text-input id="sku" name="sku" type="text" class="mt-1 block w-full" required
            autocomplete="sku" />
        <x-input-error class="mt-2" :messages="$errors->get('sku')" />
    </div>

    <!-- Category Selection -->
    <div class="flex flex-col items-start">
        <x-input-label for="category_id" :value="__('Category')" />
        <x-select id="category_id" name="category_id" class="mt-1 block w-full" required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </x-select>
        <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
    </div>

    <!-- Stock Field -->
    <div class="flex flex-col items-start">
        <x-input-label for="stock" :value="__('Stock')" />
        <x-text-input id="stock" name="stock" type="number" min="0" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('stock')" />
    </div>

    <!-- Price Field -->
    <div class="flex flex-col items-start">
        <x-input-label for="price" :value="__('Price (IDR)')" />
        <x-text-input id="price" name="price" type="number" step="0.01" min="0"
            class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('price')" />
    </div>

    <!-- Unit Field -->
    <div class="flex flex-col items-start">
        <x-input-label for="unit" :value="__('Unit')" />
        <x-text-input id="unit" name="unit" type="text" class="mt-1 block w-full" required />
        <x-input-error class="mt-2" :messages="$errors->get('unit')" />
    </div>
</div>
