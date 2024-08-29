<script setup>
    import { router, useForm } from '@inertiajs/vue3';
    import { defineProps } from 'vue';
    const props = defineProps({
        customer: Object,
        flash: String,
        errors: Object
    })

    let form = useForm({
        name    : props.customer.name,
        address : props.customer.address,
        email   : props.customer.email,
        phone   : props.customer.phone,
    })
function submit(id = null) {
    if (id != null) {
        router.put('/customer/' + id, form);
    }
    else {
        router.post('/customer', form);
    }
}


</script>

<template>
    <div class="ps relative flex flex-col items-center justify-center  overflow-hidden">
        <div class="container mx-auto">
            <perfect-scrollbar class="py-12">
                <div class="w-full p-12">
                    <h1 class="w-full text-3xl font-semibold text-left" v-if="!customer.id">Tambah Kostumer</h1>
                    <h1 class="w-full text-3xl font-semibold text-left" v-if="customer.id">Update {{ customer.name }}
                    </h1>
                    <form @submit.prevent="submit(customer.id)" class="w-full">
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4">
                            </div>
                            <div class="w-3/4">
                                <span class="text-success" v-if="flash"> {{ flash }} </span>
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4">
                            </div>
                            <div class="w-3/4">
                                <span class="text-error" v-if="errors.message">{{ errors.message }}</span>
                            </div>
                        </div>
                        <div class="form-group flex w-full pb-3">
                            <div class="w-1/4 sm-left">
                                <label for="name" class="prose prose-lg">Nama Kustomer</label>
                            </div>
                            <div class="w-3/4 sm-left">
                                <div class="text-error" v-if="errors.name" v-text="errors.name"></div>
                                <input id="name" class="input input-lg form-control input-bordered w-full py-1.5 pl-1"
                                    v-model="form.name">
                            </div>
                        </div>
                        <div class="form-group flex w-full pb-3">
                            <div class="w-1/4 sm-left">
                                <label for="name" class="prose prose-lg">Alamat Kustomer</label>
                            </div>
                            <div class="w-3/4 sm-left">
                                <div class="text-error" v-if="errors.address" v-text="errors.address"></div>
                                <textarea
                                    class="textarea-bordered  form-control textarea  textarea-lg w-full form-control py-1.5 pl-1"
                                    v-model="form.address"></textarea>
                            </div>
                        </div>
                        <div class="form-group flex w-full pb-3">
                            <div class="w-1/4 sm-left">
                                <label for="name" class="prose prose-lg">Email Kustomer</label>
                            </div>
                            <div class="w-3/4 sm-left">
                                <div class="text-error" v-if="errors.email" v-text="errors.email"></div>
                                <input id="name"
                                    class="input input-lg form-control input-bordered w-full  py-1.5 pl-1"
                                    v-model="form.email">
                            </div>
                        </div>
                        <div class="form-group flex w-full pb-3">
                            <div class="w-1/4 sm-left">
                                <label for="name" class="prose form-control prose-lg">No Telp. Kustomer</label>
                            </div>
                            <div class="w-3/4 sm-left">
                                <div class="text-error" v-if="errors.phone" v-text="errors.phone"></div>
                                <input id="name" class="input form-control input-bordered w-full  py-1.5 pl-1"
                                    v-model="form.phone">
                            </div>
                        </div>
                        <div class="form-group flex">
                            <div class="w-1/4 sm-left"></div>
                            <div class="w-2/4 sm-left">
                                <a href="/customer" class="btn btn-md btn-secondary mr-5">Kembali</a>
                                <input v-if="customer.id" type="submit" value="SIMPAN"
                                    class="btn btn-md btn-primary mt-4">
                                <input v-if="!customer.id" type="submit" value="TAMBAH"
                                    class="btn btn-md btn-primary mt-4">
                            </div>
                        </div>
                    </form>
                </div>
            </perfect-scrollbar>
        </div>
    </div>
</template>