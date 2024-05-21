import { fileURLToPath, URL } from 'node:url'
import { defineConfig, loadEnv } from 'vite'
import vue from '@vitejs/plugin-vue'
//@ts-expect-error importing js file
import loadLighthouseMeasurements from './scripts/importData'

const env = loadEnv(process.cwd(), '')

const data = await loadLighthouseMeasurements(env.VITE_APP_DIR)

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
          return `export default ${JSON.stringify(data)};`
        }
      },
    },
  ],
  resolve: {
    alias: { '@': fileURLToPath(new URL('./src', import.meta.url)) },
  },
})
