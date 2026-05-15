import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

export default defineConfig({
    root: __dirname,
    manifest: true,
    plugins: [
        laravel({
            input: [
                'src/templates/scss/main.scss',
                'src/templates/js/main.js'
            ],
            refresh: [
                './**',
                './**/**',
                '../classes/*.php',
            ],
            publicDirectory: './',
            buildDirectory: 'dist/site/templates/build',
        })
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './assets/js')
        }
    }
});

