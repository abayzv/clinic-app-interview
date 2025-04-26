import { Building2 } from "lucide-react";
import { ReactNode } from "react";

export default function AppLayout({ children }: { children: ReactNode }) {
    return (
        <div className="min-h-screen flex flex-col">
            <nav className="bg-white p-2">
                <div className="container mx-auto">
                    <a href="/dashboard" className="text-xl flex gap-2 items-center">
                        <img src="https://kusumabeauty.co.id/storage/logo/D6iozcJXturse5lVm3wNyfII5qD6WN9GEeWuzk1L.png" alt="logo" className='h-10' />
                    </a>
                </div>
            </nav>
            <main className="bg-gray-100 flex-1">
                {children}
            </main>
        </div>
    )
}