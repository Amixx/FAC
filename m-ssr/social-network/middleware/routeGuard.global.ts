import { currentUser } from '~/stores/globalStore'

export default defineNuxtRouteMiddleware((to) => {
  // return

  let nextPath: string | null = null

  if (to.fullPath === '/') nextPath = '/authenticate'

  if (to.meta.requireAuth && !currentUser.value) {
    nextPath = '/authenticate'
  } else if (to.meta.forbidAuth && currentUser.value) {
    nextPath = '/posts'
  }

  if (nextPath) return navigateTo(nextPath)
})
