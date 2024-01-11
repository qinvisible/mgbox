<script setup>
const emit = defineEmits(['close']);
const props = defineProps({
    title: {
        type: String,
        default: 'Modal'
    },
    visible: {
        type: Boolean,
        default: false
    },
});
</script>

<template>
    <div v-if="props.visible" class="modal modal-open" role="dialog">
        <div class="modal-box">
            <h3 class="font-bold text-lg">{{ props.title }}</h3>

            <div class="py-4">
                <slot />
            </div>

            <div class="modal-action">
                <slot name="action">
                    <button class="btn" @click="emit('close')">
                        Close
                    </button>
                </slot>
            </div>
        </div>
        <div class="modal-backdrop" @click="emit('close')"></div>
    </div>
</template>

