import { useEffect, useState } from "react"
import { CartItem, useCart } from "../../contexts/CartProvider"
import { DollarSign, ShoppingBasket, ShoppingCart, Ticket } from "lucide-react"
import { router } from "@inertiajs/react"
import { useCustomer } from "../../contexts/CustomerProvider"
import axios from "axios"

export default function CartPanel() {
    const { cartItems, updateQuantity, total: cartTotal } = useCart()
    const { selectedCustomer } = useCustomer()
    const [total, setTotal] = useState(0)
    const [discount, setDiscount] = useState(0)

    const handleQuantityChange = (e: React.ChangeEvent<HTMLInputElement>, cartItem: CartItem) => {
        const value = Number(e.target.value)

        if (value == 0) {
            const deleteItem = confirm('Are you sure want to delete this cart item?')
            if (!deleteItem) return
        }

        if (value > cartItem.product.stock) {
            return alert('Product out of stock, Cant add this product anymore!');
        }

        updateQuantity(cartItem.product.id, value)
    }

    const handleApplyDiscount = () => {
        setTotal(cartTotal - discount);
    }

    const handleSubmit = () => {
        if (!selectedCustomer) {
            return alert('Please select customer first!')
        }

        const payload = {
            customer_id: selectedCustomer.id,
            discount: discount,
            products: cartItems.map(item => ({
                id: item.product.id,
                quantity: item.quantity,
                price: item.product.price
            }))
        }

        const confirmSubmit = confirm('Are you sure want to create this sale?')

        if (confirmSubmit) {
            axios.post('/sales', payload).then((res) => {
                const sale = res.data.data
                if (sale.invoice_number) {
                    const confirmInvoice = confirm(`Transaction created successfully with invoice number ${sale.invoice_number}, do you want to show the invoice?`)

                    if (confirmInvoice) {
                        window.open(`/sales/${sale.id}`, '_blank')
                        router.visit('/sales/create')
                    } else {
                        router.visit('/sales/create')
                    }
                }

            }).catch(() => {
                alert('Failed to save the transaction, please try again.')
            })
        }
    }

    useEffect(() => {
        setTotal(cartTotal)
    }, [cartTotal])

    return (
        <div>
            <h3 className="font-medium mb-2 flex gap-2 items-center"><ShoppingCart size={16} /> Cart</h3>
            <div>
                {
                    cartItems.length ? (
                        <div>
                            <div className="space-y-2">
                                {
                                    cartItems.map((cartItem) => (
                                        <div key={cartItem.product.id} className="flex justify-between p-3 border rounded">
                                            <div>
                                                <div>{cartItem.product.name} - <span className="text-sm text-neutral-400">({cartItem.product.sku})</span></div>
                                                <div className="text-sm text-neutral-500 mt-2 flex gap-2 items-center">
                                                    <input onChange={(e) => handleQuantityChange(e, cartItem)} type="number" value={cartItem.quantity} className="w-12 text-sm p-1 rounded" />
                                                    <span>x Rp. {Number(cartItem.product.price).toLocaleString()}</span>
                                                </div>
                                            </div>
                                            <div>
                                                Rp. {(Number(cartItem.product.price) * cartItem.quantity).toLocaleString()}
                                            </div>
                                        </div>
                                    ))
                                }
                            </div>
                            <div className="bg-slate-100 p-3 mt-2 rounded">
                                <div className="flex justify-between items-center mb-2">
                                    <div><DollarSign size={16} className="inline-block" /> Subtotal</div>
                                    <div>Rp. {Number(cartTotal).toLocaleString()}</div>
                                </div>
                                <div className="flex justify-between items-center mb-5">
                                    <div><Ticket size={16} className="inline-block" /> Discount</div>
                                    <div className="flex gap-1">
                                        <input type="number" className="p-1 text-sm border rounded" value={discount} onChange={(e) => setDiscount(Number(e.target.value))} />
                                        <button onClick={handleApplyDiscount} className="p-1 px-2 bg-blue-500 text-white rounded text-sm">Apply</button>
                                    </div>
                                </div>
                                <div className="flex justify-between items-center border-t pt-2">
                                    <div className="text-xl">Total</div>
                                    <div className="text-xl font-bold text-blue-600">Rp. {Number(total).toLocaleString()}</div>
                                </div>
                            </div>
                        </div>
                    ) : (
                        <div className="p-5 bg-gray-50 border rounded text-center">
                            Cart's is empty.
                        </div>
                    )
                }
            </div>
            <button
                onClick={handleSubmit}
                disabled={cartItems.length == 0 || selectedCustomer == null} className="mt-5 p-3 bg-green-500 hover:bg-green-400 disabled:bg-green-400 text-white w-full rounded flex items-center justify-center gap-2">
                <ShoppingBasket />  Complete Sale
            </button>
        </div>
    )
}