import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
//@ts-expect-error importing js file
import virtualJson from './scripts/importData'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    {
      name: 'load-json-data',
      resolveId(id) {
        if (id === 'virtual:json-data') return id
      },
      load(id) {
        if (id === 'virtual:json-data') {
          return `export default ${JSON.stringify(virtualJson)};`
        }
      },
    },
  ],
  resolve: {
    alias: { '@': fileURLToPath(new URL('./src', import.meta.url)) },
  },
})
