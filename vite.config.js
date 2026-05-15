import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    root: __dirname,
    manifest: true,
    plugins: [
        laravel({
            input: [
                'src/scss/main.scss',
                'src/js/main.js'
            ],
            refresh: [
                './**',
                './**/**',
                '../classes/*.php',
            ],
            publicDirectory: './',
            buildDirectory: 'site/templates/build',
        })
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './assets/js')
        }
    }
});

