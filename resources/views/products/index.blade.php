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
                            return view('components.actions.product', ['product' => $product]);
                            })
                        </x-data-table>
                    </div>
                </div>
            </div>
        </div>

        <div id="qrModal" class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
            <div class="modal-content relative top-20 mx-auto p-5 border max-w-lg shadow-lg rounded-md bg-white">
                <div class="mt-3 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="qrTitle">QR Code</h3>
                    <div class="mt-2 px-7 py-3">
                        <div id="qrContainer" class="flex justify-center"></div>
                    </div>
                    <div class="flex justify-center gap-4 px-4 py-3">
                        <button onclick="closeModal('qrModal')"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                            Cancel
                        </button>
                        <button onclick="downloadQrCode()"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Download QR
                        </button>
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
