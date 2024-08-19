<script setup>
    
    import { router, useForm } from '@inertiajs/vue3';
    import { defineProps } from 'vue';

    const props = defineProps({
        product: Object,
        categories: Array,
        flash: String,
        errors: Object
    });
    let form  = useForm({
        'id'          : props.product.id,
        'name'        : props.product.name,
        'desc'        : props.product.desc,
        'price'       : props.product.price,
        'width'       : props.product.width,
        'height'      : props.product.height,
        'length'      : props.product.length,
        'thickness'   : props.product.thickness,
        'amount'      : props.product.amount,
        'location'    : props.product.location,
        'category_id' : props.product.category_id
  });

  function submit(id = null) {
    if (id != null) {
        console.log(form);
        router.put('/product/' + id, form);
    }
    else {
        router.post('/product', form);
    }
  }
</script>
<template>
    <div class="ps relative flex flex-col items-center justify-center overflow-hidden">
        <div class="container mx-auto ">
            <perfect-scrollbar class="py-12">
                <div class="w-full">
                    <h1 class="w-full text-3xl font-semibold text-left" v-if="!product.id">Tambah Produk</h1>
                    <h1 class="w-full text-3xl font-semibold text-left" v-if="product.id">Update {{
                        product.name }}</h1>
                </div>
                <div class="form-warp w-100 pb-10">
                    <form @submit.prevent=(submit(product.id))>

                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="name" class="prose prose-lg">Nama</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.name" v-text="errors.name"></div>
                                <input id="name" class="input input-bordered w-full py-1.5 pl-1" v-model="form.name">
                            </div>
                        </div>
                        <div class="form-group flex w-full py-5">
                            <div class="w-1/4 sm-left">
                                <label for="desc" class="prose prose-lg ">Deskripsi Produk</label>
                            </div>
                            <div class="w-2/4 sm-left">
                                <div class="text-error" v-if="errors.desc" v-text="errors.desc"></div>
                                <textarea class="textarea textarea-bordered  w-full py-1.5 pl-1" rows="5"
                                    v-model="form.desc"></textarea>
                            </div>
                        </div>
                        <div class="form-group flex w-full">
                            <div class="w-1/4 sm-left">
                                <label for="desc" class="prose prose-lg ">Lokasi Produk</label>
                            </div>
                            <div class="w-2/4 sm-left">
                                <div class="text-error" v-if="errors.location" v-text="errors.location"></div>
                                <textarea class="textarea textarea-bordered  w-full py-1.5 pl-1" rows="5"
                                    v-model="form.location"></textarea>
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="role" class="prose prose-lg">Tipe Produk</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.category_id" v-text="errors.category_id"></div>
                                <div class="cat-radio ">
                                    <div class="radio-item items-center" v-for="category in categories"
                                        :key="category.id">
                                        <input type="radio" v-model="form.category_id" :name="category.id"
                                            :value="category.id" class="radio radio-accent" :id="category.id"
                                            :checked="category.id == form.category_id" />
                                        <label class="cursor-pointer pl-2" :for="category.id">{{ category.name
                                            }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="price" class="prose prose-lg">Harga Satuan</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.price" v-text="errors.price"></div>
                                <input id="name" type="number" step="any" class="input input-bordered w-2/3 py-1.5 pl-1"
                                    v-model="form.price">
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="price" class="prose prose-lg">Lebar</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.width" v-text="errors.width"></div>
                                <input id="name" type="number" step="any" class="input input-bordered w-1/3 py-1.5 pl-1"
                                    v-model="form.width">
                                <button class="join-item rounded-r-full ml-3">mm</button>

                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="price" class="prose prose-lg">Tinggi</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.height" v-text="errors.height"></div>
                                <input id="name" type="number" step="any" class="input input-bordered w-1/3 py-1.5 pl-1"
                                    v-model="form.height">
                                <button class="join-item rounded-r-full ml-3">mm</button>
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="price" class="prose prose-lg">Panjang</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.length" v-text="errors.length"></div>
                                <input id="name" type="number" step="any" class="input input-bordered w-1/3 py-1.5 pl-1"
                                    v-model="form.length">
                                <button class="join-item rounded-r-full ml-3">mm</button>
                            </div>
                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="price" class="prose prose-lg">Ketebalan</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.thickness" v-text="errors.thickness"></div>
                                <input id="name" type="number" step="any" class="input input-bordered w-1/3 py-1.5 pl-1"
                                    v-model="form.thickness">
                                <button class="join-item rounded-r-full ml-3">mm</button>
                            </div>
                        </div>

                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4"><label for="price" class="prose prose-lg">Jumlah barang</label></div>
                            <div class="w-2/4">
                                <div class="text-error" v-if="errors.amount" v-text="errors.amount"></div>
                                <input id="name" type="number" step="any" class="input input-bordered w-1/3 py-1.5 pl-1"
                                    v-model="form.amount">
                                <button class="join-item rounded-r-full ml-3">pcs</button>
                            </div>

                        </div>
                        <div class="form-group flex align-center py-5">
                            <div class="w-1/4">
                            </div>
                            <div class="w-2/4">
                                <span class="text-success" v-if="flash"> {{ flash }} </span>
                                <span class="text-error" v-if="errors.errors">{{ errors.errors }}</span>
                            </div>
                        </div>
                        <div class="form-group flex">
                            <div class="w-1/4 sm-left"></div>
                            <div class="w-2/4 sm-left">
                                <a href="/product" class="btn btn-md btn-secondary mr-5">KEMBALI</a>
                                <input v-if="product.id" type="submit" value="SIMPAN"
                                    class="btn btn-md btn-primary mt-4">
                                <input v-if="!product.id" type="submit" value="TAMBAH"
                                    class="btn btn-md btn-primary mt-4">
                            </div>
                        </div>
                    </form>
                </div>

            </perfect-scrollbar>
        </div>
    </div>
</template>