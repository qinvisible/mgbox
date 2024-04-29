<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
});
</script>

<template>
    <nav class="navbar px-8 text-white bg-neutral-900">
        <div class="flex-1">
            <Link href="/" class="text-xl">{{ props.title }}</Link>
        </div>

        <div class="flex-none">
            <div className="avatar placeholder">
                <div className="bg-neutral text-neutral-content rounded-full w-8">
                    <span className="text-xs">MG</span>
                </div>
            </div>
        </div>
    </nav>
</template>
