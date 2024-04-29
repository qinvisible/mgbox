<script setup>
import { Navbar } from '@/Components/Navbar';
import { Sidebar } from '@/Components/Sidebar';
</script>

<template>
    <div class="relative flex flex-col min-h-screen">
        <Navbar title="MG-Box" />

        <div class="flex flex-1">
            <Sidebar
                :items="[
                    {
                        label: 'Dashboard',
                        icon: 'mdi:view-dashboard',
                        href: '/dashboard'
                    },
                    {
                        label: 'Order Management',
                        icon: 'mdi:cart',
                        items: [
                            { label: 'Orders', href: '/order' },
                            { label: 'Payments', href: '/payment' },
                            { label: 'Customers', href: '/customer' },
                        ]
                    },
                    {
                        label: 'Product Management',
                        icon: 'mdi:package',
                        items: [
                            { label: 'Products', href: '/product' },
                            { label: 'Categories', href: '/category' },
                        ]
                    },
                    {
                        label: 'Users & Roles',
                        icon: 'mdi:user-supervisor',
                        items: [
                            { label: 'Users', href: '/user' },
                            { label: 'Roles', href: '/role' },
                        ]
                    }
                ]"
            />

            <div class="flex-1 bg-neutral-300">
                <slot/>
            </div>
        </div>
    </div>
</template>
