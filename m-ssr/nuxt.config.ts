// https://nuxt.com/docs/api/configuration/nuxt-config

export default defineNuxtConfig({
  devtools: { enabled: true },
  devServer: {
    port: 8000,
    host: '0.0.0.0',
  },
  postcss: { plugins: { tailwindcss: {}, autoprefixer: {} } },
  css: ['~/assets/css/main.css'],
  vite: { vue: { script: { propsDestructure: true } } },
  typescript: { typeCheck: true },
  app: {
    head: {
      htmlAttrs: { lang: 'lv' },
    },
  },
  nitro: {
    compressPublicAssets: true,
    // prerender: { crawlLinks: true },
  },
})
