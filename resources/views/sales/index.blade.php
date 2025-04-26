@section('title', 'Sales')

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sales') }}
            </h2>

            <a href="/sales/create">
                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                    + Add Sales
                </button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-data-table class="w-full" :items="$sales" :columns="[
                        'invoice_number' => 'Invoice Number',
                        'customer.name' => 'Customer',
                        'formatted_discount' => 'Discount',
                        'formatted_total_price' => 'Total',
                        'created_at' => 'Created At',
                    ]" paginated>
                        @slot('actions', function ($item) {
                            return view('components.action-buttons', [
                            'deleteRoute' => 'sales.destroy',
                            'showRoute' => 'sales.show',
                            'itemId' => $item->id,
                            'itemName' => 'sale ' . $item->name,
                            'modalId' => 'deleteModal-' . uniqId(),
                            ]);
                            })
                        </x-data-table>
                    </div>
                </div>
            </div>
        </div>

        <x-modal-form modal-id="createSalesModal" title="Create Sales" action="{{ route('sales.store') }}" method="POST">
            @slot('body')
                @include('sales.partials.create')
            @endslot
        </x-modal-form>
    </x-app-layout>
