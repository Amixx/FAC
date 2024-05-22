<template>
  <section class="bg-gray-50">
    <div
      class="flex flex-col items-center justify-center lg:py-0 md:h-screen mx-auto px-6 py-8"
    >
      <div class="bg-white md:mt-0 rounded-lg shadow sm:max-w-md w-full xl:p-0">
        <div class="md:space-y-6 p-6 sm:p-8 space-y-4">
          <h1
            class="font-bold leading-tight md:text-2xl text-gray-900 text-xl tracking-tight"
          >
            Ielogojies vai reģistrējies!
          </h1>
          <form class="md:space-y-6 space-y-4" @submit.prevent="authenticate">
            <div>
              <label
                class="block font-medium mb-2 text-gray-900 text-sm"
                for="email"
                >E-pasts</label
              >
              <input
                id="email"
                class="bg-gray-50 block border border-gray-300 focus:border-red-600 focus:ring-red-600 p-2.5 rounded-lg sm:text-sm text-gray-900 w-full"
                name="email"
                placeholder="vards@uznemums.com"
                required
                type="email"
              />
            </div>
            <div>
              <label
                class="block font-medium mb-2 text-gray-900 text-sm"
                for="password"
                >Parole</label
              >
              <input
                id="password"
                class="bg-gray-50 block border border-gray-300 focus:border-red-600 focus:ring-red-600 p-2.5 rounded-lg sm:text-sm text-gray-900 w-full"
                name="password"
                placeholder="••••••••"
                required
                type="password"
              />
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-start">
                <div class="flex h-5 items-center">
                  <input
                    id="remember"
                    class="bg-gray-50 border border-gray-300 focus:ring-3 focus:ring-red-300 h-4 rounded w-4"
                    type="checkbox"
                  />
                </div>
                <div class="ml-3 text-sm">
                  <label class="text-gray-500" for="remember"
                    >Atcerēties mani</label
                  >
                </div>
              </div>
              <a
                class="font-medium hover:underline text-red-600 text-sm"
                href="#"
                >Aizmirsi paroli?</a
              >
            </div>
            <button
              class="bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium hover:bg-red-700 px-5 py-2.5 rounded-lg text-center text-sm text-white w-full"
              type="submit"
            >
              Ielogoties / reģistrējies
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router'
import { ref } from 'vue'
import { currentUser } from '@/stores/globalStore'
import type { User } from '@/types/Data'
import { parseErrorAndShowMessage } from '@/helpers/global'

const router = useRouter()

const email = ref('')
const password = ref('')

const authenticate = async () => {
  try {
    const data = (await (
      await fetch(`${import.meta.env.VITE_API_BASE_URL}/authenticate`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email.value, password: password.value }),
      })
    ).json()) as { user: User; redirect: string }
    currentUser.value = data.user
    await router.push({ name: data.redirect.toUpperCase() })
  } catch (e) {
    console.error(e)
    parseErrorAndShowMessage(e)
  }
}
</script>
