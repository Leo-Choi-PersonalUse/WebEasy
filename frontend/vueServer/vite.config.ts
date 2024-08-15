import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import vueI18n from '@intlify/vite-plugin-vue-i18n';
import { fileURLToPath, URL } from 'node:url'

export default defineConfig({
    server: {
        watch: {
          usePolling: true,
         },
         host: true, // Here
         strictPort: true,
         port: 3100, 
      },
    plugins: [
        vue(),
        vueI18n({
            include: path.resolve(__dirname, './src/locales/**'),
        }),
    ],
    // resolve: {
    //     alias: {
    //         '@': path.resolve(__dirname, './src'),
    //     },
    // },
    resolve: {
        alias: {
          '@': fileURLToPath(new URL('./src', import.meta.url))
        }
      },
    optimizeDeps: {
        include: ['quill'],
    },
});
