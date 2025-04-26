export interface Product {
    id: number;
    name: string;
    sku: string;
    category_id: number;
    stock: number;
    price: string;
    unit: Unit;
    created_at: string;
    updated_at: string;
}

export enum Unit {
    Botol = "botol",
    Box = "box",
    Pcs = "pcs",
}