<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-4">
                <x-summary-card name="Total Product" :value="$metrics['total_products']" />
                <x-summary-card name="Total Categories" :value="$metrics['total_categories']" />
                <x-summary-card name="Total Customers" :value="$metrics['total_customers']" />
                <x-summary-card name="Total Sales" :value="$metrics['total_sales']" />
                <x-summary-card name="Total Product Sales" :value="$metrics['total_products_sold']" />
                <x-summary-card name="Total Revenue" :value="'Rp. ' . number_format($metrics['total_revenue'])" />
            </div>
        </div>
    </div>
</x-app-layout>
