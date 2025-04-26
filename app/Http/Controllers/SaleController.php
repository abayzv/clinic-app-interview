<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('saleDetails.product')->latest()->paginate(5);
        $customers = Customer::all();
        return view('sales.index', compact('sales', 'customers'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string|unique:sales',
            'customer_name' => 'required|string|max:255',
            'discount' => 'nullable|numeric|min:0',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0'
        ]);

        $total = collect($request->products)->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });

        $total -= $request->discount ?? 0;

        $sale = Sale::create([
            'invoice_number' => $request->invoice_number,
            'customer_name' => $request->customer_name,
            'discount' => $request->discount,
            'total_price' => $total
        ]);

        foreach ($request->products as $product) {
            $sale->saleDetails()->create([
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $product['quantity'] * $product['price']
            ]);

            Product::where('id', $product['id'])
                ->decrement('stock', $product['quantity']);
        }

        return redirect()->route('sales.show', $sale)
            ->with('success', 'Sale created successfully.');
    }

    public function show(Sale $sale)
    {
        $sale->load('saleDetails.product');
        return view('sales.show', compact('sale'));
    }

    public function destroy(Sale $sale)
    {
        // Optional: Restore product stock before deletion
        foreach ($sale->saleDetails as $detail) {
            Product::where('id', $detail->product_id)
                ->increment('stock', $detail->quantity);
        }

        $sale->delete();

        return redirect()->route('sales.index')
            ->with('success', 'Sale deleted successfully.');
    }
}
