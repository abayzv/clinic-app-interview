import { Product } from "types/products"
import { useProduct } from "../../contexts/ProductProvider"
import { useCart } from "../../contexts/CartProvider"

export default function ProductGrid() {
    const { filteredProducts } = useProduct()
    const { addToCart } = useCart()

    return (
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-2">
            {
                filteredProducts.map((product: Product) => (
                    <div
                        onClick={() => { addToCart(product) }}
                        key={product.id} className="border p-4 rounded hover:shadow hover:bg-slate-50 transition-all text-sm cursor-pointer">
                        <div className="text-lg">{product.name}</div>
                        <div className="text-neutral-400">{product.sku} ({product.stock})</div>
                        <div className="mt-2 text-blue-700 font-medium">Rp. {Number(product.price).toLocaleString()}</div>
                    </div>
                ))
            }
        </div>
    )
}