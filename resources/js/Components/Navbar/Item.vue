<script setup>
const props = defineProps({
    level: {
        type: Number,
        default: 3,
    },
});
</script>

<template>
    <div v-if="level > 0">
        <span>Iseng aja</span>
        <Item :level="level - 1" />
    </div>
</template>
