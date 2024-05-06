import { createRouter, createWebHistory } from 'vue-router'
import AuthenticateView from '@/views/AuthenticateView.vue'
import { isAuthenticated } from '@/stores/globalStore'

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
      path: '/todos',
      name: 'TODOS',
      component: () => import('./views/TodosView.vue'),
      props(route) {
        return {
          lastPage: route.query.lastPage
            ? parseInt(route.query.lastPage as string)
            : 1,
          includeCompleted: route.query.includeCompleted
            ? route.query.includeCompleted === 'true'
            : false,
        }
      },
      meta: { requireAuth: true },
    },
    {
      path: '/todo-categories',
      name: 'TODO_CATEGORIES',
      component: () => import('./views/TodoCategoriesView.vue'),
      meta: { requireAuth: true },
    },
    {
      path: '/spent-times',
      name: 'SPENT_TIMES',
      component: () => import('./views/SpentTimesView.vue'),
      meta: { requireAuth: true },
    },
  ],
})

router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth && !isAuthenticated.value) {
    next({ name: 'AUTHENTICATE' })
  } else if (to.meta.forbidAuth && isAuthenticated.value) {
    next({ name: 'TODOS' })
  } else next()
})

export default router
