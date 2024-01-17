<script setup>
    import { useModal, Dialog } from '@/Components/Modal';
    import { router } from '@inertiajs/vue3';
    const props = defineProps({
        categories: Array,
        flash: String,
        errors: Object,
        messages: String
    });

    const removeModal = useModal((category) => {
        console.log(category);
        router.delete('/category/' + category.id);
    });
</script>

<template>
    <div class="relative ps flex  flex-col items-center" style="height: 100vh">
            <perfect-scrollbar>
                <div class="container " style="height: 100vh;">
                    <h2 class="text-2xl py-5">Kategori</h2>
                    <a href="/category/create" class="btn btn-neutral btn-md mb-4">Tambah Kategori</a>
                    <div v-if="props.flash"><span class="text-success pb-3"> {{ props.flash }} </span></div>
                    <!-- <div v-if="errors.roleused" class="text-error py-4">{{ errors.roleused }}</div>-->
                    <div class="h-100 pb-12">
                        <table class="table overflow-x-auto border table-zebra text-sm font-light dark:border-neutral-500 table table-pin-rows">
                            <thead class="border-b font-medium dark:border-neutral-50">
                                <tr>
                                    <th class="border-r px-6 py-4 dark:border-neutral-500 text-lg font-medium">Nama Kategori</th>
                                    <th class="border-r px-6 py-4 dark:border-neutral-500 text-lg font-medium">Deskripsi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cat in categories" :key="cat.id" class="justify-start">
                                    <td class="border-r px-6 py-4 dark:border-neutral-500 text-lg ">{{ cat.name }}</td>
                                    <td class="border-r px-6 py-4 dark:border-neutral-500 text-sm ">{{ cat.desc  }}</td>
                                    <td>
                                        <a :href="'/category/' + cat.id" class="btn btn-primary btn-sm mr-3" title="Edit Peran">
                                            <svg st xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 576 512">
                                                <path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z" fill="#FFF"></path>
                                            </svg>
                                        </a>
                                        <button class="btn btn-secondary btn-sm" @click="removeModal.open(cat)">
                                            <svg  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"/>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <Teleport to="body">
                    <Dialog
                        title="Hapus Kategori"
                        message="Apakah Anda yakin ingin menghapus kategori ini?"
                        :visible="removeModal.state.visible"
                        :loading="removeModal.state.loading"
                        @confirm="removeModal.confirm"
                        @close="removeModal.close"
                    />
                </Teleport>
            </perfect-scrollbar>
    </div>
    
</template>