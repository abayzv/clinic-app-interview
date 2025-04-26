<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Invoice') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto py-6 px-4">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="flex justify-between items-center p-6 border-b">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">#{{ $sale->invoice_number }}</h1>
                            <p class="text-gray-600">{{ $sale->created_at }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="window.print()"
                                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                                <i class="fas fa-print mr-2"></i> Print Invoice
                            </button>
                        </div>
                    </div>

                    <div class="p-6">

                        <!-- Invoice I -->
                        <div class="flex" style="margin-bottom: 2rem">
                            <div class="flex-1 border p-4">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">From</h2>
                                <p class="text-gray-700">Your Company Name</p>
                                <p class="text-gray-700">123 Business Street</p>
                                <p class="text-gray-700">City, State ZIP</p>
                                <p class="text-gray-700">Phone: (123) 456-7890</p>
                                <p class="text-gray-700">Email: info@yourcompany.com</p>
                            </div>

                            <div class="flex-1 border p-4">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Bill To</h2>
                                <p class="text-gray-700">{{ $sale->customer->name }}</p>
                                <p class="text-gray-700">{{ $sale->customer->address }}</p>
                                <p class="text-gray-700">Phone: {{ $sale->customer->phone }}</p>
                            </div>
                        </div>

                        <!-- Invoice Items -->
                        <div class="overflow-x-auto mt-4">
                            <table class="w-full bg-white">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-4 text-left">Product</th>
                                        <th class="py-3 px-4 text-right">Quantity</th>
                                        <th class="py-3 px-4 text-right">Price</th>
                                        <th class="py-3 px-4 text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm">
                                    @foreach ($sale->saleDetails as $item)
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3 px-4 text-left">
                                                {{ $item->product->name ?? 'Product #' . $item->product_id }}
                                            </td>
                                            <td class="py-3 px-4 text-right">{{ $item->quantity }}</td>
                                            <td class="py-3 px-4 text-right">{{ number_format($item->price, 2) }}
                                            </td>
                                            <td class="py-3 px-4 text-right">
                                                {{ number_format($item->subtotal, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Invoice Summary -->
                        <div class="flex justify-end">
                            <div class="w-1/3">
                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex justify-between mb-2 gap-2">
                                        <span class="font-semibold text-gray-600">Subtotal:</span>
                                        <span class="text-gray-800">
                                            Rp {{ number_format($sale->saleDetails->sum('subtotal'), 2) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between mb-2 gap-2">
                                        <span class="font-semibold text-gray-600">Discount:</span>
                                        <span class="text-gray-800">-Rp {{ number_format($sale->discount, 2) }}</span>
                                    </div>
                                    <div
                                        class="flex justify-between font-bold text-lg border-t border-gray-200 pt-2 mt-2">
                                        <span class="text-gray-600">Total:</span>
                                        <span class="text-red-500">Rp
                                            {{ number_format($sale->total_price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mt-8 pt-8 border-t border-gray-200">
                            <h3 class="font-semibold text-gray-800">Notes</h3>
                            <p class="text-gray-600">Thank you for your business!</p>
                        </div>
                    </div>

                    <!-- Invoice Footer -->
                    <div class="bg-gray-50 p-6 text-center text-gray-500 text-sm">
                        <p>This invoice was created on {{ date('F d, Y', strtotime($sale->created_at)) }}</p>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

{{-- print --}}
<div class="print mx-auto py-6 px-4 hidden">
    <div class="bg-white rounded-lg overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">#{{ $sale->invoice_number }}</h1>
                <p class="text-gray-600">{{ $sale->created_at }}</p>
            </div>
            <div class="flex space-x-2">
                <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                    <i class="fas fa-print mr-2"></i> Print Invoice
                </button>
            </div>
        </div>

        <div class="p-6">

            <!-- Invoice I -->
            <div class="flex" style="margin-bottom: 2rem">
                <div class="flex-1 border p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">From</h2>
                    <p class="text-gray-700">Your Company Name</p>
                    <p class="text-gray-700">123 Business Street</p>
                    <p class="text-gray-700">City, State ZIP</p>
                    <p class="text-gray-700">Phone: (123) 456-7890</p>
                    <p class="text-gray-700">Email: info@yourcompany.com</p>
                </div>

                <div class="flex-1 border p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Bill To</h2>
                    <p class="text-gray-700">{{ $sale->customer->name }}</p>
                    <p class="text-gray-700">{{ $sale->customer->address }}</p>
                    <p class="text-gray-700">Phone: {{ $sale->customer->phone }}</p>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="overflow-x-auto mt-4">
                <table class="w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-4 text-left">Product</th>
                            <th class="py-3 px-4 text-right">Quantity</th>
                            <th class="py-3 px-4 text-right">Price</th>
                            <th class="py-3 px-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @foreach ($sale->saleDetails as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 text-left">
                                    {{ $item->product->name ?? 'Product #' . $item->product_id }}
                                </td>
                                <td class="py-3 px-4 text-right">{{ $item->quantity }}</td>
                                <td class="py-3 px-4 text-right">{{ number_format($item->price, 2) }}
                                </td>
                                <td class="py-3 px-4 text-right">
                                    {{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Invoice Summary -->
            <div class="flex justify-end">
                <div class="w-1/3">
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between mb-2 gap-2">
                            <span class="font-semibold text-gray-600">Subtotal:</span>
                            <span class="text-gray-800">
                                Rp {{ number_format($sale->saleDetails->sum('subtotal'), 2) }}
                            </span>
                        </div>
                        <div class="flex justify-between mb-2 gap-2">
                            <span class="font-semibold text-gray-600">Discount:</span>
                            <span class="text-gray-800">-Rp {{ number_format($sale->discount, 2) }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg border-t border-gray-200 pt-2 mt-2">
                            <span class="text-gray-600">Total:</span>
                            <span class="text-red-500">Rp
                                {{ number_format($sale->total_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="font-semibold text-gray-800">Notes</h3>
                <p class="text-gray-600">Thank you for your business!</p>
            </div>
        </div>

        <!-- Invoice Footer -->
        <div class="bg-gray-50 p-6 text-center text-gray-500 text-sm">
            <p>This invoice was created on {{ date('F d, Y', strtotime($sale->created_at)) }}</p>
        </div>
    </div>
</div>
