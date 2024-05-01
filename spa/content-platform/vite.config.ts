import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import VueDevTools from 'vite-plugin-vue-devtools'
import mkcert from 'vite-plugin-mkcert'

// https://vitejs.dev/config/
export default defineConfig({
  server: {
    host: true,
    port: 8000,
    strictPort: true,
    hmr: { port: 8000 },
  },
  preview: {
    host: true,
    port: 8000,
  },
  plugins: [
    vue({ script: { propsDestructure: true } }),
    VueDevTools(),
    mkcert({ hosts: ['thesis-project.local.io'] }),
  ],
  resolve: {
    alias: { '@': fileURLToPath(new URL('./src', import.meta.url)) },
  },
})
