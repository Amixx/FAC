import type { RouteRecordName } from 'vue-router'

export const routeNames = [
  'index',
  'about-us',
  'news',
  'offers',
  'contacts',
] as const

export const routeNameToPageIndex = (
  routeName: RouteRecordName | null | undefined,
) => {
  return routeNames.indexOf(routeName as (typeof routeNames)[number])
}
