import { createRouter, createWebHistory } from 'vue-router'
import HomeView from './views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'HOME',
      component: HomeView,
    },
    {
      path: '/catalogue/:page?',
      name: 'CATALOGUE',
      component: () => import('./views/CatalogueView.vue'),
      props(route) {
        return {
          page: route.params.page ? parseInt(route.params.page as string) : 1,
          category: route.query.category ?? null,
        }
      },
    },
    {
      path: '/product/:id',
      name: 'PRODUCT',
      component: () => import('./views/ProductView.vue'),
      props(route) {
        return {
          id: route.params.id ? parseInt(route.params.id as string) : null,
        }
      },
    },
    {
      path: '/cart',
      name: 'CART',
      component: () => import('./views/CartView.vue'),
    },
    {
      path: '/checkout',
      name: 'CHECKOUT',
      component: () => import('./views/CheckoutView.vue'),
    },
  ],
})

export default router
