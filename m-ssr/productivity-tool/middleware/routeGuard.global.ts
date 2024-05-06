import { isAuthenticated } from '~/stores/globalStore'

export default defineNuxtRouteMiddleware((to) => {
  // return

  let nextPath: string | null = null

  if (to.fullPath === '/') nextPath = '/authenticate'

  if (to.meta.requireAuth && !isAuthenticated.value) {
    nextPath = '/authenticate'
  } else if (to.meta.forbidAuth && isAuthenticated.value) {
    nextPath = '/todos'
  }

  if (nextPath) return navigateTo(nextPath)
})
