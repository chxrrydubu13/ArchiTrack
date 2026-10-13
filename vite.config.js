import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

const cssDirectory = path.resolve('resources/css');

const cssFiles = fs
    .readdirSync(cssDirectory)
    .filter((file) => file.endsWith('.css'))
    .map((file) => `resources/css/${file}`);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...cssFiles,
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});