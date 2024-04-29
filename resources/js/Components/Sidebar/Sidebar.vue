<script setup>
import Item from './Item.vue';

const props = defineProps({
    items: Array,
});
</script>

<template>
    <aside class="min-h-full">
        <ul class="menu h-full bg-neutral text-neutral-content">
            <li v-for="item in props.items">
                <Item v-bind="item"/>
            </li>
        </ul>
    </aside>
</template>
