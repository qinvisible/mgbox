<script>
import IslandLayout from '@/Layouts/Island.vue'

export default {
    layout: IslandLayout,
}
</script>

<template>
    <div class="flex w-full lg:w-1/2 m-10 lg:m-0 overflow-hidden rounded-xl bg-white">
        <div class="flex-1 hidden lg:block">
            <img src="@assets/img/login-image.jpg" alt="Login" class="w-full h-full object-cover">
        </div>
        <div class="flex-1 p-10 space-y-10">
            <h1 class="text-2xl font-semibold">Login</h1>
            <form class="space-y-3">
                <div>
                    <label class="label">
                        <span class="text-base label-text">Email</span>
                    </label>
                    <input type="text" name="email" placeholder="Enter Email" class="input input-bordered w-full">
                </div>
                <div>
                    <label class="label">
                        <span class="text-base label-text">Password</span>
                    </label>
                    <input type="password" name="password" placeholder="Enter Password" class="input input-bordered w-full">
                </div>
                <div class="text-right">
                    <a href="#" class="text-sm text-natural-600 font-semibold hover:underline hover:text-blue-600">Forget Password?</a>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-full">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
