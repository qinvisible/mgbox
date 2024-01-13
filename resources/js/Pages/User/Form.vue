<script setup>
    import { router, useForm } from '@inertiajs/vue3';
    let props = defineProps({
        user    : Object,
        errors: Object,
        flash: String,
        roles: Array
    
    })
    function submit(id = null) {
        if (id != null) {
            router.put('/user/' + id, form);
        }
        else {
            router.post('/user', form);
        }
    }
    let form = useForm({
        'id'    : String,
        'name'  : String, 
        'email' : String, 
        'password'  : String, 
        'confirm_password' : String,
        'role_id'   : String
    });
</script>
<template>
    <div class="ps relative flex flex-col items-center justify-center  overflow-hidden">
        <div class="container mx-auto">
            <perfect-scrollbar>
                <div class="w-full p-6">
                        <h1 class="w-full text-3xl font-semibold text-left" v-if="!user.id">Tambah Pengguna</h1>
                        <h1 class="w-full text-3xl font-semibold text-left" v-if="user.id">Update {{ role.name }}</h1>
                </div>
                <div class="form-warp w-100">
                    <form @submit.prevent=(submit(user.id))>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="name" class="prose prose-lg">Nama</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.name" v-text="errors.name"></div>
                                <input id="name" class="input input-bordered w-full max-w-xs py-1.5 pl-1" 
                                    v-model="form.name" 
                                >
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="email" class="prose prose-lg">Email</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.email" v-text="errors.email"></div>
                                <input id="email" class="input input-bordered w-full max-w-xs py-1.5 pl-1" 
                                    v-model="form.email"
                                >
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="name" class="prose prose-lg">Password</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.email" v-text="errors.password"></div>
                                <input id="name" type="password" class="input input-bordered w-full max-w-xs py-1.5 pl-1" 
                                    v-model="form.password"
                                >
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="name" class="prose prose-lg">Password</label></div>
                            <div class="w-2/4">
                                <input id="name" type="password" class="input input-bordered w-full max-w-xs py-1.5 pl-1" 
                                    v-model="form.confirm_password"
                                >
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="name" class="prose prose-lg">Akses Yang Diberikan</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.email" v-text="errors.email"></div>
                                <select class="select w-full input-bordered max-w-xs" name="name" v-model="form.role_id">
                                    <option v-for="role in roles" :key="role.id" :value="role.id">{{role.name}}</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group flex">
                                <div class="w-1/4 sm-left"></div>
                                <div class="w-2/4 sm-left">
                                    <a  href="/user" class="btn btn-md btn-secondary mr-5">Kembali</a>
                                    <input v-if="user.id" type="submit" value="SIMPAN" class="btn btn-md btn-primary mt-4">
                                    <input v-if="!user.id" type="submit" value="TAMBAH" class="btn btn-md btn-primary mt-4">
                                </div>
                            </div>
                    </form>
                </div>
    
            </perfect-scrollbar>
        </div>
    </div>
</template>