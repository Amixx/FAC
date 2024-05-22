// https://nuxt.com/docs/api/configuration/nuxt-config

export default defineNuxtConfig({
  devtools: { enabled: true },
  devServer: { port: 8001, host: '0.0.0.0' },
  postcss: { plugins: { tailwindcss: {}, autoprefixer: {} } },
  css: ['~/assets/css/main.css', 'vue3-toastify/dist/index.css'],
  vue: { propsDestructure: true },
  typescript: { typeCheck: true },
  app: { head: { htmlAttrs: { lang: 'lv' } } },
  nitro: { compressPublicAssets: true },
})
