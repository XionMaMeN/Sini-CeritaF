import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'public/css/app.css', // CSS utama
                'resources/js/app.js', // JS utama
            ],
            refresh: true,
        }),
    ]
});
