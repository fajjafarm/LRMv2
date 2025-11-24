import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                '@tailadmin/laravel/dist/css/tailadmin.css',
                '@tailadmin/laravel/dist/js/tailadmin.js'
            ],
            refresh: true,
        }),
    ],
});