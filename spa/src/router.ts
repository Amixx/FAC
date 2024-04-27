import { createRouter, createWebHistory } from 'vue-router'
import HomeView from './views/HomeView.vue'
import importedData from './data/data.json'
import { useHead } from '@unhead/vue'

const data = importedData as Data

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'HOME',
      component: HomeView,
      props: { data: data.pages[0] },
      meta: {
        title: data.pages[0].title,
        description: data.pages[0].metaDescription,
        keywords: data.pages[0].metaKeywords,
      },
    },
    {
      path: '/about-us',
      name: 'ABOUT_US',
      component: () => import('./views/AboutUsView.vue'),
      props: { data: data.pages[1] },
      meta: {
        title: data.pages[1].title,
        description: data.pages[1].metaDescription,
        keywords: data.pages[1].metaKeywords,
      },
    },
    {
      path: '/news',
      name: 'NEWS',
      component: () => import('./views/NewsView.vue'),
      props: { data: data.pages[2] },
      meta: {
        title: data.pages[2].title,
        description: data.pages[2].metaDescription,
        keywords: data.pages[2].metaKeywords,
      },
    },
    {
      path: '/offers',
      name: 'OFFERS',
      component: () => import('./views/OffersView.vue'),
      props: { data: data.pages[3] },
      meta: {
        title: data.pages[3].title,
        description: data.pages[3].metaDescription,
        keywords: data.pages[3].metaKeywords,
      },
    },
    {
      path: '/contacts',
      name: 'CONTACTS',
      component: () => import('./views/ContactsView.vue'),
      props: { data: data.pages[4] },
      meta: {
        title: data.pages[4].title,
        description: data.pages[4].metaDescription,
        keywords: data.pages[4].metaKeywords,
      },
    },
  ],
})

router.beforeEach((to) => {
  useHead({
    title: to.meta.title,
    meta: [
      { name: 'description', content: to.meta.description },
      { name: 'keywords', content: to.meta.keywords },
    ],
  })
})

export default router
