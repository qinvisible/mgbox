<template>
    <div class="relative flex flex-col items-center justify-center h-screen overflow-hidden">
        <div class="w-full p-6 m-auto lg:max-w-lg">
            <h1 class="text-3xl font-semibold text-center">Login</h1>

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

                <a href="#" class="text-xs text-gray-600 hover:underline hover:text-blue-600">Forget Password?</a>

                <div>
                    <button type="submit" class="btn btn-primary w-full">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
