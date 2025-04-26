<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportService
{
    public function getSalesReport(Request $request)
    {
        $mode = $request->get('mode', 'daily');
        $date = $request->get('date', now()->toDateString());

        $sales = Sale::query()
            ->when($mode == 'daily', function ($query) use ($date) {
                $query->whereDate('created_at', $date);
            })
            ->when($mode == 'weekly', function ($query) use ($date) {
                $startOfWeek = Carbon::parse($date)->startOfWeek();
                $endOfWeek = Carbon::parse($date)->endOfWeek();

                $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
            })
            ->when($mode == 'monthly', function ($query) use ($date) {
                $month = Carbon::parse($date)->format('m');
                $year = Carbon::parse($date)->format('Y');

                $query->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);
            })
            ->orderBy('created_at', 'desc')
            ->with(['customer', 'saleDetails'])
            ->get();

        $saleIds = $sales->pluck('id');

        $totalProductsSold = SaleDetail::whereIn('sale_id', $saleIds)->sum('quantity');
        $totalSales = $sales->count();
        $totalRevenue = $sales->sum('total_price');

        return [
            'sales' => $sales,
            'metrics' => [
                'total_products_sold' => $totalProductsSold,
                'total_sales' => $totalSales,
                'total_revenue' => $totalRevenue,
            ]
        ];
    }

    public function getProductsSoldReport(?string $startDate = null, ?string $endDate = null)
    {
        $query = SaleDetail::with('product')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereHas('sale', function ($saleQuery) use ($startDate, $endDate) {
                    $saleQuery->whereBetween('created_at', [
                        Carbon::parse($startDate)->startOfDay(),
                        Carbon::parse($endDate)->endOfDay()
                    ]);
                });
            })
            ->selectRaw('product_id, sum(quantity) as total_quantity, sum(subtotal) as total_revenue')
            ->groupBy('product_id')
            ->with('product');

        return $query->get();
    }
}
