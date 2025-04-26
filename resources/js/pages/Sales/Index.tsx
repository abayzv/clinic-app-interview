import { Head } from "@inertiajs/react";
import AppLayout from "../../layout/app-layout";
import { Product } from "../../types/products";
import { ProductProvider } from "../../contexts/ProductProvider";
import { Category } from "../../types/categories";
import SalesMain from "../../components/sales";
import { CartProvider } from "../../contexts/CartProvider";
import { CustomerProvider } from "../../contexts/CustomerProvider";
import { Customer } from "../../types/customer";

export default function Sales({ products, categories, customers }: { products: Product[], categories: Category[], customers: Customer[] }) {
    return (
        <AppLayout>
            <Head title="Transaction" />
            <CartProvider>
                <ProductProvider products={products} categories={categories}>
                    <CustomerProvider customers={customers}>
                        <SalesMain />
                    </CustomerProvider>
                </ProductProvider>
            </CartProvider>
        </AppLayout>
    );
}
