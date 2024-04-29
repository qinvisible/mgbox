<script setup>
import { Link } from '@inertiajs/vue3';
import { Icon } from '@iconify/vue';

const props = defineProps({
    label: {
        type: String,
        required: true,
    },
    icon: {
        type: String,
    },
    href: {
        type: String,
    },
    items: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <template v-if="props.items.length">
        <details open>
            <summary>
                <Icon v-if="props.icon" :icon="props.icon" /> {{ props.label }}
            </summary>
            <ul>
                <li v-for="item in props.items">
                    <Item v-bind="item" />
                </li>
            </ul>
        </details>
    </template>
    <template v-else>
        <Link :href="props.href">
            <Icon v-if="props.icon" :icon="props.icon" /> {{ props.label }}
        </Link>
    </template>
</template>
