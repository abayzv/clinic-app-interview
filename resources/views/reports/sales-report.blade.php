<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Sales Report
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-4 mb-6">
                <x-summary-card name="Barang Terjual" value="{{ $metrics['total_products_sold'] }}" />
                <x-summary-card name="Total Penjualan" value="{{ $metrics['total_sales'] }}" />
                <x-summary-card name="Total Revenue" value="Rp {{ number_format($metrics['total_revenue']) }}" />
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="GET" class="mb-4 flex space-x-2 items-end justify-end">
                        <div>
                            <select name="mode" class="border p-2 rounded">
                                <option value="daily" {{ request('mode') == 'daily' ? 'selected' : '' }}>Daily
                                </option>
                                <option value="weekly" {{ request('mode') == 'weekly' ? 'selected' : '' }}>Weekly
                                </option>
                                <option value="monthly" {{ request('mode') == 'monthly' ? 'selected' : '' }}>Monthly
                                </option>
                            </select>
                        </div>

                        <div>
                            <input type="{{ request('mode') === 'monthly' ? 'month' : 'date' }}" name="date"
                                value="{{ request('date') }}" class="border p-2 rounded" />
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Filter
                            </button>
                        </div>
                    </form>

                    <x-data-table class="w-full" :items="$sales" :columns="[
                        'invoice_number' => 'Invoice',
                        'customer.name' => 'Customer',
                        'total_price' => 'Total',
                        'created_at' => 'Date',
                    ]" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
