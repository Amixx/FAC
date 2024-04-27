// https://nuxt.com/docs/api/configuration/nuxt-config
import importedData from './data/data.json'

const data = importedData as Data

const routeNames = ['index', 'about-us', 'news', 'offers', 'contacts'] as const

const routeNameToDataIndex = (routeName: (typeof routeNames)[number]) => {
  return routeNames.indexOf(routeName)
}

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
  hooks: {
    'pages:extend'(pages) {
      pages.forEach((page) => {
        const dataIndex = routeNameToDataIndex(
          page.name as (typeof routeNames)[number],
        )
        page.meta = {
          data: data.pages[dataIndex],
          title: data.pages[dataIndex].title,
          description: data.pages[dataIndex].metaDescription,
          keywords: data.pages[dataIndex].metaKeywords,
        }
      })
    },
  },
  app: {
    head: {
      htmlAttrs: { lang: 'lv' },
    },
  },
  nitro: {
    compressPublicAssets: true,
  },
})
