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
        'id'    : props.user.id,
        'name'  : props.user.name, 
        'email' : props.user.email, 
        'password'  : props.user.password, 
        'password_confirmation' : props.user.password,
        'role_id'   : props.user.role_id
    });
</script>
<template>
    <div class="ps relative flex flex-col items-center justify-center  overflow-hidden">
        <div class="container mx-auto p-10">
            <perfect-scrollbar>
                <div class="w-full">
                        <h1 class="w-full text-3xl font-semibold text-left" v-if="!user.id">Tambah Pengguna</h1>
                        <h1 class="w-full text-3xl font-semibold text-left" v-if="user.id">Update {{ user.name }}</h1>
                </div>
                <div class="form-warp w-100">
                    <form @submit.prevent=(submit(user.id))>
                        <div class="form-group flex align-center py-5">
                                <div class="w-1/4">
                                </div>
                                <div class="w-2/4">
                                    <span class="text-success" v-if="flash"> {{ flash }} </span>
                                </div>
                        </div>
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
                            <div class="w-1/4"><label for="role" class="prose prose-lg">Akses Yang Diberikan</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.role" v-text="errors.role"></div>
                                <select class="select w-full input-bordered max-w-xs" name="form.role_id" v-model="form.role_id">
                                    <option v-for="role in roles" :key="role.id" :value="role.id">{{role.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5" v-if="!user.id">
                            <div class="w-1/4"><label for="password" class="prose prose-lg">Password</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.password_confirmation" v-text="errors.password_confirmation"></div>
                                <input id="name" type="password" class="input input-bordered w-full max-w-xs py-1.5 pl-1" 
                                    v-model="form.password"
                                >
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5" v-if="!user.id">
                            <div class="w-1/4"><label for="password_confirmation" class="prose prose-lg">Confirm Password</label></div>
                            <div class="w-2/4">
                                <input id="name"  type="password" class="input input-bordered w-full max-w-xs py-1.5 pl-1" 
                                    v-model="form.password_confirmation"
                                >
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