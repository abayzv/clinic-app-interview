import { User2 } from "lucide-react"
import { useCustomer } from "../../contexts/CustomerProvider"

export default function CustomerSelect() {
    const { customers, selectCustomer, clearSelectedCustomer } = useCustomer()

    const handleSelectCustomer = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const value = customers.find((customer) => customer.id == Number(e.target.value))
        if (value) {
            selectCustomer(value)
        }
    }

    return (
        <div className="grid">
            <label htmlFor="customer" className="font-medium flex gap-2 items-center"><User2 size={16} /> Customer</label>
            <select id="customer-select" name="customer" className="rounded mt-2 border-neutral-300" onChange={handleSelectCustomer} >
                <option onClick={() => clearSelectedCustomer} value="">Select Customer</option>
                {
                    customers.map((customer) => (
                        <option key={customer.id} value={customer.id}>{customer.name}</option>
                    ))
                }
            </select>
        </div>
    )
}