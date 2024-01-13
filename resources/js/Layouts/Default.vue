<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="relative flex flex-row h-screen overflow-hidden">
        <div class="drawer lg:drawer-open">
            <input id="app-drawer" type="checkbox" class="drawer-toggle" />

            <div class="drawer-content p-4">
                <slot />
            </div>

            <div class="drawer-side">
                <label for="app-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul class="menu p-4 w-48 min-h-full bg-base-200 text-base-content">
                    <li><Link href="/">Home</Link></li>
                    <li><Link href="/role">Role</Link></li>
                    <li><Link href="/user">Pengguna</Link></li>
                </ul>
            </div>
        </div>
    </div>
</template>
