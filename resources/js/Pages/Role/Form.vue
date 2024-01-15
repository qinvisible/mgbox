<template>
    <div class="ps relative flex flex-col items-center justify-center  overflow-hidden">
        <div class="container mx-auto">
            <perfect-scrollbar>
                <div class="w-full p-12">
                    <h1 class="w-full text-3xl font-semibold text-left" v-if="!role.id">Tambah Akses Pengguna</h1>
                    <h1 class="w-full text-3xl font-semibold text-left" v-if="role.id">Update {{ role.name }}</h1>
                    <form @submit.prevent="submit(role.id)" class="w-full">
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4">
                            </div>
                            <div class="w-2/4">
                                <span class="text-success" v-if="flash"> {{ flash }} </span>
                                <span v-if="errors.message">{{  errors.message }}</span>
                            </div>
                        </div>
                        <div class="form-group flex w-full">
                            <div class="w-1/4 sm-left">
                                <label for="name" class="prose prose-lg">Nama</label>
                            </div>
                            <div class="2/4 sm-left">
                                <div class="text-error" v-if="errors.name" v-text="errors.name"></div>
                                <input id="name" class="input input-bordered w-full max-w-xs py-1.5 pl-1" 
                                    v-model="form.name" 
    
                                >
                            </div>
                        </div>
                        
                        <div class="form-group flex align-center pb-3">
                            <div class="w-1/4">
                                <label for="permission" class="prose-sm">Akses yang dimiliki</label>
                            </div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.permission" v-text="errors.permission"></div>
                                <div class="form-control" v-for="prmdata in permission_data" :key="prmdata">
                                    <label class="label cursor-pointer justify-start">
                                        <input type="checkbox" 
                                        name="role.permission[]" 
                                        v-model="form.permission"
                                        :checked = "props.role.permission.includes(prmdata)"
                                        class="checkbox" 
                                        :value="prmdata" />
                                        <span class="label-text m-3">{{ prmdata }}</span> 
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group flex">
                            <div class="w-1/4 sm-left"></div>
                            <div class="w-2/4 sm-left">
                                <a  href="/role" class="btn btn-md btn-secondary mr-5">Kembali</a>
                                <input v-if="role.id" type="submit" value="SIMPAN" class="btn btn-md btn-primary mt-4">
                                <input v-if="!role.id" type="submit" value="TAMBAH" class="btn btn-md btn-primary mt-4">
                            </div>
                        </div>
                    </form>
                </div>
            </perfect-scrollbar>
        </div>
    </div>
</template>
<script setup >
    import { defineProps } from 'vue';
    import { router, useForm  } from '@inertiajs/vue3';
    const props = defineProps({
        role: Object,
        flash: String,
        permission_data: Array,
        errors: Object,
    });
    let form = useForm({
        id: props.role.id,
        name: props.role.name,
        permission: props.role.permission,
    });
    
    
    function submit(id = null) {
        if (id != null) {
            router.put('/role/'+id, form);
        }
        else {
            router.post('/role', form, (respose) => {
            })
            
        }
    }
</script>