import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

const { NODE_ENV } = process.env;

let baseConfig = {    
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
};

if (NODE_ENV === 'development') {
    baseConfig = {
        ...baseConfig,
        server: {
            https: false,
            hmr: {
                host: 'localhost'
            }
        },
    }
}

export default defineConfig(baseConfig)
