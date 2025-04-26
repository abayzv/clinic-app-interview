import { useEffect, useState } from "react"
import CartPanel from "./cart-panel"
import CategoriesGrid from "./categories-grid"
import CustomerSelect from "./customer-select"
import ProductGrid from "./products-grid"
import { useProduct } from "../../contexts/ProductProvider"
import { X } from "lucide-react"

export default function SalesMain() {
    const [activeTab, setActiveTab] = useState<'products' | 'categories'>('products')

    const { categoryFilter, setCategoryFilter, categories } = useProduct()

    const renderFilterText = () => {
        const selectedCategory = categories.find((category) => category.id === categoryFilter)
        return categoryFilter && (
            <div className="mb-2 flex gap-2 items-center">
                <span>Showing filter for "<strong>{selectedCategory?.name}</strong>"</span>
                <button onClick={() => { setCategoryFilter(null) }}>
                    <X size={18} className="text-red-500" />
                </button>
            </div>
        )
    }

    useEffect(() => {
        setActiveTab('products')
    }, [categoryFilter])

    return (
        <div className="container mx-auto py-4 px-2">
            <div className="flex flex-col lg:flex-row  gap-4 items-start">
                <div className="flex-1 bg-white rounded shadow p-5 min-h-[32rem] w-full">
                    <div className="mb-5 flex flex-col lg:flex-row w-full gap-2 justify-between items-center">
                        <h3 className="text-xl font-semibold">Kusuma Beauty Clinic</h3>
                        <div className="flex gap-2">
                            <button
                                onClick={() => { setActiveTab('categories') }}
                                className={`px-5 py-2 rounded ${activeTab === 'categories' ? 'bg-sky-500 text-white' : 'bg-gray-200'}`}>Categories</button>
                            <button
                                onClick={() => { setActiveTab("products") }}
                                className={`px-5 py-2 rounded ${activeTab === 'products' ? 'bg-green-500 text-white' : 'bg-gray-200'}`}>Products</button>
                        </div>
                    </div>
                    {activeTab === 'categories' && (
                        <CategoriesGrid />
                    )}
                    {activeTab === 'products' && (
                        <>
                            {renderFilterText()}
                            <ProductGrid />
                        </>
                    )}
                </div>
                <div className="lg:w-1/3 w-full bg-white rounded shadow space-y-3 p-5">
                    <CustomerSelect />
                    <CartPanel />
                </div>
            </div>
        </div>
    )
}