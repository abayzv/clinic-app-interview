import { createContext, ReactNode, useContext, useMemo, useState } from 'react';
import { Product } from '../types/products';
import { Category } from '../types/categories';

type ProductContextType = {
    products: Product[];
    categoryFilter: number | null;
    setCategoryFilter: (category: number | null) => void;
    filteredProducts: Product[];
    categories: Category[]
};

export const ProductContext = createContext<ProductContextType>({
    products: [],
    categoryFilter: null,
    setCategoryFilter: () => { },
    filteredProducts: [],
    categories: []
});

export const ProductProvider = ({ children, products, categories }: { children: ReactNode; products: Product[], categories: Category[] }) => {
    const [categoryFilter, setCategoryFilter] = useState<number | null>(null);

    const filteredProducts = useMemo(() => {
        if (!categoryFilter) return products;
        return products.filter(product => product.category_id == categoryFilter);
    }, [products, categoryFilter]);

    return (
        <ProductContext.Provider value={{ products, categoryFilter, setCategoryFilter, filteredProducts, categories }}>
            {children}
        </ProductContext.Provider>
    );
};

export const useProduct = () => useContext(ProductContext);
