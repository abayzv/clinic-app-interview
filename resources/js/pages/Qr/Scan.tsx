import { Scanner } from '@yudiel/react-qr-scanner';
import axios from 'axios';
import { Camera } from 'lucide-react';
import { useEffect, useState } from 'react';
import { Product } from '../../types/products';
import { Head } from '@inertiajs/react';

export default function Scan() {
    const [productId, setProductId] = useState<string | null>(null)
    const [product, setProduct] = useState<Product | null>(null);

    useEffect(() => {
        if (productId) {
            axios.get(`/products/scan/${productId}`).then((res) => {
                setProduct(res.data.product)
            })
        }
    }, [productId])

    return (
        <>
            <Head title="Scan Product" />
            <div className='min-h-svh flex flex-col bg-[#860000] '>
                <div className='flex justify-center p-1 bg-white'>
                    <a href="/dashboard">
                        <img src="https://kusumabeauty.co.id/storage/logo/D6iozcJXturse5lVm3wNyfII5qD6WN9GEeWuzk1L.png" alt="logo" className='h-12' />
                    </a>
                </div>
                <div className='p-5 flex-1 flex flex-col justify-center'>
                    <div className='bg-white p-5 rounded-xl pb-24'>
                        {
                            product ? (
                                <>
                                    <div className='text-center mb-10'>
                                        <h3 className='text-2xl text-neutral-700 font-bold'>Product Detail</h3>
                                        <p className='text-neutral-500 text-sm mt-1'>Here's detail of {product.sku}</p>
                                    </div>
                                    <table className='w-full border'>
                                        <tbody className="divide-y divide-gray-200">
                                            <tr className="odd:bg-white even:bg-gray-50">
                                                <td className="px-4 py-2 font-semibold">SKU</td>
                                                <td className="px-4 py-2">{product.sku}</td>
                                            </tr>
                                            <tr className="odd:bg-white even:bg-gray-50">
                                                <td className="px-4 py-2 font-semibold">Name</td>
                                                <td className="px-4 py-2">{product.name}</td>
                                            </tr>
                                            <tr className="odd:bg-white even:bg-gray-50">
                                                <td className="px-4 py-2 font-semibold">Category</td>
                                                <td className="px-4 py-2">{product.category?.name}</td>
                                            </tr>
                                            <tr className="odd:bg-white even:bg-gray-50">
                                                <td className="px-4 py-2 font-semibold">Stock</td>
                                                <td className="px-4 py-2">{product.stock}</td>
                                            </tr>
                                            <tr className="odd:bg-white even:bg-gray-50">
                                                <td className="px-4 py-2 font-semibold">Price</td>
                                                <td className="px-4 py-2">{product.price}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </>
                            ) : (
                                <>
                                    <div className='text-center mb-10'>
                                        <h3 className='text-2xl text-neutral-700 font-bold'>Product Scanner</h3>
                                        <p className='text-neutral-500 text-sm mt-1'>Scan QR Code to show product details</p>
                                    </div>
                                    <Scanner onScan={(result) => setProductId(result?.[0]?.rawValue)} />
                                </>
                            )
                        }
                    </div>
                </div>
                <div className='p-5'>
                    <button disabled={!product} onClick={() => { setProduct(null) }} className='bg-white disabled:bg-opacity-50 w-full p-5 rounded font-medium flex items-center gap-2 justify-center'><Camera /> Scan Again</button>
                </div>
            </div>
        </>
    )
}