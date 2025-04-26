<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products') }}
            </h2>

            <button onclick="openModal('createCategoryModal')"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                + Add Product
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-data-table class="w-full" :items="$products" :columns="[
                        'sku' => 'SKU',
                        'name' => 'Name',
                        'category.name' => 'Category',
                        'stock' => 'Stock',
                        'formatedPrice' => 'Price',
                        'unit' => 'Unit',
                        'created_at' => 'Created At',
                    ]" paginated>
                        @slot('actions', function ($product) {
                            return view('components.action-buttons', [
                            'editRoute' => 'products.edit',
                            'deleteRoute' => 'products.destroy',
                            'itemId' => $product->id,
                            'itemName' => 'product ' . $product->name,
                            'modalId' => 'deleteModal-' . uniqId(),
                            ]);
                            })
                        </x-data-table>
                    </div>
                </div>
            </div>
        </div>

        <x-modal-form modal-id="createCategoryModal" title="Create Product" action="{{ route('products.store') }}"
            method="POST">
            @slot('body')
                @include('products.partials.create')
            @endslot
        </x-modal-form>
    </x-app-layout>
