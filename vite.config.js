import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'public/css/add-admin-user.css',
                'public/css/followUprepir.css',
                'public/css/repair_blade_admin.css',
                'public/css/sidebar.css',
                'public/css/styles_login.css',
                'public/css/styles.css',
                'public/css/technician-work-schedulepdf.css',
                'public/js/datatables-simple-demo.js',
                'public/js/scripts.js',
                'public/js/sidebar.js',
            ],
            refresh: true,
        }),
    ],
});
