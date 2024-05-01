import {
  createRouter,
  createWebHistory,
  type RouteRecordName,
} from 'vue-router'
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
      path: '/about-us',
      name: 'ABOUT_US',
      component: () => import('./views/AboutUsView.vue'),
    },
    {
      path: '/news',
      name: 'NEWS',
      component: () => import('./views/NewsView.vue'),
    },
    {
      path: '/offers',
      name: 'OFFERS',
      component: () => import('./views/OffersView.vue'),
    },
    {
      path: '/contacts',
      name: 'CONTACTS',
      component: () => import('./views/ContactsView.vue'),
    },
  ],
})

export default router

const routeNames = ['HOME', 'ABOUT_US', 'NEWS', 'OFFERS', 'CONTACTS'] as const

export const routeNameToPageIndex = (
  routeName: RouteRecordName | null | undefined,
) => {
  return routeNames.indexOf(routeName as (typeof routeNames)[number])
}
