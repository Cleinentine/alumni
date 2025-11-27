import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                
                'resources/js/app.js',
                'resources/js/password-text.js',
                'resources/js/employment-form-dropdown.js',
                'resources/js/address-dropdown.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
