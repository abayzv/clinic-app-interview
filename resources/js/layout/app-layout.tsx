import { Building2 } from "lucide-react";
import { ReactNode } from "react";

export default function AppLayout({ children }: { children: ReactNode }) {
    return (
        <div className="min-h-screen flex flex-col">
            <nav className="bg-white p-4">
                <div className="container mx-auto">
                    <a href="/dashboard" className="text-xl flex gap-2 items-center">
                        <Building2 />
                        <span className="font-bold text-red-900">Kusuma</span> Beauty
                    </a>
                </div>
            </nav>
            <main className="bg-gray-100 flex-1">
                {children}
            </main>
        </div>
    )
}