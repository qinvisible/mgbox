import { defineConfig } from 'vite';
import vue from "@vitejs/plugin-vue";
import laravel from 'laravel-vite-plugin';
import { fileURLToPath } from 'node:url'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: [
            { find: '@', replacement: fileURLToPath(new URL('./resources/js', import.meta.url)) },
            { find: '@css', replacement: fileURLToPath(new URL('./resources/css', import.meta.url)) },
            { find: '@assets', replacement: fileURLToPath(new URL('./resources/assets', import.meta.url)) },
        ]
    }
});
