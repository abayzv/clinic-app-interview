<?php

namespace App\Http\Controllers;

use App\Models\SaleDetail;
use App\Models\Sale;
use App\Models\Product;

class SaleDetailController extends Controller
{
    public function destroy(SaleDetail $saleDetail)
    {
        Product::where('id', $saleDetail->product_id)
            ->increment('stock', $saleDetail->quantity);

        $sale = Sale::find($saleDetail->sale_id);
        $sale->decrement('total_price', $saleDetail->subtotal);

        $saleDetail->delete();

        return redirect()->route('sales.edit', $saleDetail->sale_id)
            ->with('success', 'Item removed successfully.');
    }
}
