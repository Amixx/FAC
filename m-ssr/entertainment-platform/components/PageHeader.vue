<template>
  <header class="container">
    <nav class="bg-red-500 border-gray-200 text-white">
      <div
        class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4"
      >
        <button
          aria-controls="navbar-default"
          class="focus:outline-none focus:ring-2 focus:ring-gray-200 h-10 hover:bg-gray-100 inline-flex items-center justify-center md:hidden p-2 rounded-lg text-gray-500 text-sm w-10"
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
        <div
          v-if="currentUser"
          id="navbar-default"
          class="md:block md:w-auto w-full"
        >
          <ul
            class="border border-gray-100 flex flex-col font-medium md:border-0 md:flex-row md:mt-0 md:p-0 md:space-x-8 mt-4 p-4 rounded-lg rtl:space-x-reverse"
          >
            <li>
              <NuxtLink class="block md:p-0 px-3 py-2 text-white" to="/">
                Videoklipu katalogs
              </NuxtLink>
            </li>
            <li>
              <button class="block md:p-0 px-3 py-2 text-white" @click="logout">
                Beigt darbu
              </button>
            </li>
          </ul>
        </div>
        <NuxtLink
          class="font-semibold self-center text-2xl whitespace-nowrap"
          to="/"
        >
          VideoPlatforma
        </NuxtLink>
      </div>
    </nav>
  </header>
</template>

<script setup lang="ts">
import { currentUser } from '@/stores/globalStore'
import { parseErrorAndShowMessage } from '@/helpers/global'

const router = useRouter()

const logout = async () => {
  try {
    const redirectRouteName = await $fetch<string>(
      `${import.meta.env.VITE_API_BASE_URL}/logout`,
      { method: 'POST' },
    )
    currentUser.value = null
    await router.push(`/${redirectRouteName}`)
  } catch (e) {
    console.error(e)
    parseErrorAndShowMessage(e)
  }
}
</script>
