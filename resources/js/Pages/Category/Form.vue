<script setup>
    import { router, useForm } from '@inertiajs/vue3';
    import { defineProps } from 'vue';
    const props = defineProps({
        category: Object,
        flash: String,
        errors: Object
    })

    let form = useForm({
        'name'  : props.category = props.category.name,
        'desc'  : props.category = props.category.desc,
    });

    function submit(id = null) {
        if (id != null) {
            router.put('/category/' + id, form);
        }
        else {
            router.post('/category', form, (respose) => {
            })
        }
    }
</script>

<template>
    <div class="ps relative flex flex-col items-center justify-center  overflow-hidden">
        <div class="container mx-auto">
            <perfect-scrollbar class="py-12">
                <div class="w-full p-12">
                    <h1 class="w-full text-3xl font-semibold text-left" v-if="!category.id">Tambah Kategori</h1>
                    <h1 class="w-full text-3xl font-semibold text-left" v-if="category.id">Update {{ category.name }}
                    </h1>
                    <form @submit.prevent="submit(category.id)" class="w-full">
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4">
                            </div>
                            <div class="w-2/4">
                                <span class="text-success" v-if="flash"> {{ flash }} </span>
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4">
                            </div>
                            <div class="w-2/4">
                                <span class="text-error" v-if="errors.message">{{ errors.message }}</span>
                            </div>
                        </div>
                        <div class="form-group flex w-full pb-3">
                            <div class="w-1/4 sm-left">
                                <label for="name" class="prose prose-lg">Nama Kategori</label>
                            </div>
                            <div class="2/4 sm-left">
                                <div class="text-error" v-if="errors.name" v-text="errors.name"></div>
                                <input id="name" class="input input-bordered w-full max-w-xs py-1.5 pl-1"
                                    v-model="form.name">
                            </div>
                        </div>

                        <div class="form-group flex align-center pb-3">
                            <div class="w-1/4">
                                <label for="permission" class="prose-sm">Deskripsi Kategori</label>
                            </div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.desc" v-text="errors.desc"></div>
                                <div class="form-control">
                                    <textarea class="textarea textarea-primary" placeholder="Keterangan"
                                        v-model="form.desc"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group flex">
                            <div class="w-1/4 sm-left"></div>
                            <div class="w-2/4 sm-left">
                                <a href="/category" class="btn btn-md btn-secondary mr-5">Kembali</a>
                                <input v-if="category.id" type="submit" value="SIMPAN"
                                    class="btn btn-md btn-primary mt-4">
                                <input v-if="!category.id" type="submit" value="TAMBAH"
                                    class="btn btn-md btn-primary mt-4">
                            </div>
                        </div>
                    </form>
                </div>
            </perfect-scrollbar>
        </div>
    </div>
</template>