import { createRouter, createWebHistory } from 'vue-router'
import AuthenticateView from '@/views/AuthenticateView.vue'
import { currentUser } from '@/stores/globalStore'

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
      path: '/posts',
      name: 'POSTS',
      component: () => import('./views/PostsView.vue'),
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
      path: '/posts/new/:postId?',
      name: 'NEW_POST',
      component: () => import('./views/NewPostView.vue'),
      props(route) {
        return {
          postId: route.params.postId
            ? parseInt(route.params.postId as string)
            : null,
        }
      },
      meta: { requireAuth: true },
    },
    {
      path: '/user/:id',
      name: 'USER',
      component: () => import('./views/UserView.vue'),
      props(route) {
        return {
          id: route.params.id ? parseInt(route.params.id as string) : null,
        }
      },
      meta: { requireAuth: true },
    },
  ],
})

router.beforeEach((to, from, next) => {
  if (to.meta.requireAuth && !currentUser.value) {
    next({ name: 'AUTHENTICATE' })
  } else if (to.meta.forbidAuth && currentUser.value) {
    next({ name: 'POSTS' })
  } else next()
})

export default router
