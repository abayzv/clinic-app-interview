import { Category } from "../../types/categories"
import { useProduct } from "../../contexts/ProductProvider"

export default function CategoriesGrid() {

    const { categories, setCategoryFilter } = useProduct()

    return (
        <div className="grid grid-cols-4 gap-2">
            {
                categories.map((category: Category) => (
                    <div key={category.id} onClick={() => setCategoryFilter(category.id)} className="border bg-sky-50 p-7 rounded hover:shadow hover:bg-sky-100 hover:shadow-red-50 transition-all text-sm text-center cursor-pointer">
                        {category.name}
                    </div>
                ))
            }
        </div>
    )
}