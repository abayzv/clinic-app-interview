<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetail;

class DashboardService
{
    public function getMetrics(): array
    {
        return [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_customers' => Customer::count(),
            'total_sales' => Sale::count(),
            'total_revenue' => Sale::sum('total_price'),
            'total_products_sold' => SaleDetail::sum('quantity'),
        ];
    }
}
