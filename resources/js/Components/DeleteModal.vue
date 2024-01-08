<template>
	<dialog id="confirmation" class="modal">
		<div class="modal-box">
			<h3 class="font-bold text-lg">Hello!</h3>
			<p class="py-4">Press ESC key or click the button below to close</p>
			<div class="modal-action">
			<form method="dialog">
				<!-- if there is a button in form, it will close the modal -->
				<button class="btn">Close</button>
			</form>
			</div>
		</div>
	</dialog>
</template>

<script setup>
import { defineProps } from 'vue';
import { router } from "@inertiajs/vue3"

const props = defineProps({
    role: Object
})
console.log(props.role);


</script>
