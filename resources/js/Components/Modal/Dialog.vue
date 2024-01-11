<script setup>
import Modal from './Modal.vue'

const emit = defineEmits(['close', 'confirm']);
const props = defineProps({
    title: {
        type: String,
        default: 'Modal'
    },
    message: {
        type: String,
        optional: true
    },
    visible: {
        type: Boolean,
        default: false
    },
    loading: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <Modal :title="props.title" :visible="props.visible">
        <template #default>
            <p>{{ props.message }}</p>
        </template>

        <template #action>
            <slot name="action">
                <button class="btn" @click="emit('close')">
                    Cancel
                </button>
                <button class="btn btn-primary" @click="emit('confirm')">
                    <span v-if="props.loading" class="loading loading-spinner"></span>
                    Confirm
                </button>
            </slot>
        </template>
    </Modal>
</template>

