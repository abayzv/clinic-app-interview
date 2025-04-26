@section('title', 'Edit Product ' . $product->name)

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Product ') . $product->name }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Update current product item.') }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('products.update', $product) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <!-- Name Field -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $product->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- SKU Field -->
                        <div>
                            <x-input-label for="sku" :value="__('SKU')" />
                            <x-text-input id="sku" name="sku" type="text" class="mt-1 block w-full"
                                :value="old('sku', $product->sku)" required autocomplete="sku" />
                            <x-input-error class="mt-2" :messages="$errors->get('sku')" />
                        </div>

                        <!-- Category Selection -->
                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <x-select id="category_id" name="category_id" class="mt-1 block w-full" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <!-- Stock Field -->
                        <div>
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input id="stock" name="stock" type="number" min="0"
                                class="mt-1 block w-full" :value="old('stock', $product->stock)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
                        </div>

                        <!-- Price Field -->
                        <div>
                            <x-input-label for="price" :value="__('Price (IDR)')" />
                            <x-text-input id="price" name="price" type="number" step="0.01" min="0"
                                class="mt-1 block w-full" :value="old('price', $product->price)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>

                        <!-- Unit Field -->
                        <div>
                            <x-input-label for="unit" :value="__('Unit')" />
                            <x-text-input id="unit" name="unit" type="text" class="mt-1 block w-full"
                                :value="old('unit', $product->unit)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('unit')" />
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
