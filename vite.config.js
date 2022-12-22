import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({

    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        react(),
    ],
    server: {
        open: true,
        origin: 'http://127.0.0.1:8080/'
      },
   build: {
    chunkSizeWarningLimit: 1600,
  },
});
 ``
