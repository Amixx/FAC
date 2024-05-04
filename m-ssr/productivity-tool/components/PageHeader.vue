<template>
  <header class="container">
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
      <div
        class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4"
      >
        <NuxtLink
          class="font-semibold self-center text-2xl whitespace-nowrap"
          to="/todos"
        >
          Mērķu Meistars
        </NuxtLink>
        <button
          aria-controls="navbar-default"
          aria-expanded="false"
          class="focus:outline-none focus:ring-2 focus:ring-gray-200 h-10 hover:bg-gray-100 inline-flex items-center justify-center md:hidden p-2 rounded-lg text-gray-500 text-sm w-10"
          data-collapse-toggle="navbar-default"
          type="button"
        >
          <span class="sr-only">Atvērt navigāciju</span>
          <svg
            aria-hidden="true"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 17 14"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M1 1h15M1 7h15M1 13h15"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            />
          </svg>
        </button>
        <div v-if="isAuthenticated" class="hidden md:block md:w-auto w-full">
          <ul
            class="bg-gray-50 border border-gray-100 flex flex-col font-medium md:bg-white md:border-0 md:flex-row md:mt-0 md:p-0 md:space-x-8 mt-4 p-4 rounded-lg rtl:space-x-reverse"
          >
            <li>
              <NuxtLink class="block md:p-0 px-3 py-2" to="/todos">
                Darāmie darbi
              </NuxtLink>
            </li>
            <li>
              <NuxtLink class="block md:p-0 px-3 py-2" to="/todo-categories">
                Darbu kategorijas
              </NuxtLink>
            </li>
            <li>
              <NuxtLink class="block md:p-0 px-3 py-2" to="/spent-times">
                Pavadītais laiks
              </NuxtLink>
            </li>
            <li>
              <button class="block md:p-0 px-3 py-2" @click="logout">
                Beigt darbu
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<script setup lang="ts">
import { isAuthenticated } from '@/stores/globalStore'

const router = useRouter()

const logout = async () => {
  try {
    const redirectRouteName = await $fetch<string>(
      `${import.meta.env.VITE_API_BASE_URL}/logout`,
      { method: 'POST', headers: { 'Content-Type': 'application/json' } },
    )
    isAuthenticated.value = false
    await router.push(`/${redirectRouteName}`)
  } catch (e) {
    console.error(e)
  }
}
</script>
