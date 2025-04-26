<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        $categories = Category::all();
        $customers = Customer::all();
        return Inertia::render('Sales/Index', compact('products', 'categories', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
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
            'customer_id' => $request->customer_id,
            'discount' => $request->discount ?? 0,
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

        return response()->json([
            'success' => true,
            'data' => $sale
        ]);
    }

    public function show(Sale $sale)
    {
        $sale->load('saleDetails.product');
        return view('sales.show', compact('sale'));
    }

    public function destroy(Sale $sale)
    {
        foreach ($sale->saleDetails as $detail) {
            Product::where('id', $detail->product_id)
                ->increment('stock', $detail->quantity);
        }

        $sale->delete();

        return redirect()->route('sales.index')
            ->with('success', 'Sale deleted successfully.');
    }
}
