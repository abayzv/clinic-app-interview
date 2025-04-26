import React, { createContext, useContext, useState, ReactNode } from 'react';
import { Customer } from '../types/customer';

type CustomerContextType = {
    customers: Customer[];
    selectedCustomer: Customer | null;
    selectCustomer: (customer: Customer) => void;
    clearSelectedCustomer: () => void;
};

const CustomerContext = createContext<CustomerContextType>({
    customers: [],
    selectedCustomer: null,
    selectCustomer: () => { },
    clearSelectedCustomer: () => { },
});

export const useCustomer = () => useContext(CustomerContext);

export const CustomerProvider = ({ children, customers }: { children: ReactNode; customers: Customer[] }) => {
    const [selectedCustomer, setSelectedCustomer] = useState<Customer | null>(null);

    const selectCustomer = (customer: Customer) => {
        setSelectedCustomer(customer);
    };

    const clearSelectedCustomer = () => {
        setSelectedCustomer(null);
    };

    return (
        <CustomerContext.Provider value={{ customers, selectedCustomer, selectCustomer, clearSelectedCustomer }}>
            {children}
        </CustomerContext.Provider>
    );
};
