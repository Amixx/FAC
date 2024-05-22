import { createRouter, createWebHistory } from 'vue-router'
import AuthenticateView from '@/views/AuthenticateView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: { name: 'AUTHENTICATE' },
    },
    {
      path: '/authenticate',
      name: 'AUTHENTICATE',
      component: AuthenticateView,
      meta: { forbidAuth: true },
    },
    {
      path: '/',
      name: 'HOME',
      component: () => import('./views/HomeView.vue'),
      props(route) {
        return {
          lastPage: route.query.lastPage
            ? parseInt(route.query.lastPage as string)
            : 1,
        }
      },
      meta: { requireAuth: true },
    },
    {
      path: '/video/:id',
      name: 'VIDEO',
      component: () => import('./views/VideoView.vue'),
      props(route) {
        return {
          id: route.params.id ? parseInt(route.params.id as string) : null,
        }
      },
      meta: { requireAuth: true },
    },
  ],
})

// router.beforeEach((to, from, next) => {
//   if (to.meta.requireAuth && !currentUser.value) {
//     next({ name: 'AUTHENTICATE' })
//   } else if (to.meta.forbidAuth && currentUser.value) {
//     next({ name: 'HOME' })
//   } else next()
// })

export default router
