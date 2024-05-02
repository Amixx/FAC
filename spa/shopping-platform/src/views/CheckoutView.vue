<template>
  <div class="container mx-auto">
    <div class="m-auto">
      <div class="bg-white mt-5 rounded-lg shadow">
        <div class="flex">
          <div class="flex-1 overflow-hidden pl-5 py-5">
            <!-- Icon Placeholder -->
            <svg
              class="align-text-top inline"
              fill="#000000"
              height="20.5"
              width="21"
              xmlns="http://www.w3.org/2000/svg"
            >
              <g>
                <path
                  id="svg_1"
                  d="m4.88889,2.07407l14.22222,0l0,20l-14.22222,0l0,-20z"
                  fill="none"
                  stroke="null"
                />
                <path
                  id="svg_2"
                  d="m7.07935,0.05664c-3.87,0 -7,3.13 -7,7c0,5.25 7,13 7,13s7,-7.75 7,-13c0,-3.87 -3.13,-7 -7,-7zm-5,7c0,-2.76 2.24,-5 5,-5s5,2.24 5,5c0,2.88 -2.88,7.19 -5,9.88c-2.08,-2.67 -5,-7.03 -5,-9.88z"
                />
                <circle id="svg_3" cx="7.04807" cy="6.97256" r="2.5" />
              </g>
            </svg>
            <h1 class="font-semibold inline leading-none text-2xl">Adrese</h1>
          </div>
        </div>
        <div class="pb-5 px-5">
          <input :class="inputClasses" placeholder="Vārds, uzvārds" />
          <input :class="inputClasses" placeholder="Adrese" />
          <div class="flex gap-2">
            <div class="flex-grow">
              <input :class="inputClasses" placeholder="Pilsēta" />
            </div>
            <div class="flex-grow w-1/4">
              <input :class="inputClasses" placeholder="LV-..." />
            </div>
          </div>
        </div>
      </div>
    </div>

    <form class="flex flex-wrap gap-3 p-5 w-full" @submit.prevent="makePayment">
      <label class="flex flex-col relative w-full">
        <span class="font-bold mb-3">Kartes numurs</span>
        <input
          class="border-2 border-gray-200 peer pl-12 placeholder-gray-300 pr-2 py-2 rounded-md"
          placeholder="0000 0000 0000 0000"
          type="text"
        />
      </label>

      <label class="flex flex-1 flex-col relative">
        <span class="font-bold mb-3">Kartes derīguma termiņš</span>
        <input
          class="border-2 border-gray-200 peer pl-12 placeholder-gray-300 pr-2 py-2 rounded-md"
          placeholder="MM/YY"
          type="text"
        />
      </label>

      <label class="flex flex-1 flex-col relative">
        <span class="font-bold mb-3">CVC/CVV</span>
        <input
          class="border-2 border-gray-200 peer pl-12 placeholder-gray-300 pr-2 py-2 rounded-md"
          placeholder="&bull;&bull;&bull;"
          type="text"
        />
      </label>

      <button
        class="bg-purple-500 duration-300 ease-in-out font-bold hover:bg-purple-600 px-4 py-2 rounded text-white transform transition w-full"
        type="submit"
      >
        Apmaksāt pasūtījumu
      </button>
    </form>
  </div>
</template>

<script setup lang="ts">
import type { CheckoutPageData } from '@/types/Data'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { toast } from 'vue3-toastify'

const router = useRouter()

const data = ref<CheckoutPageData>()

const fetchData = async () => {
  try {
    data.value = await (
      await fetch(`${import.meta.env.VITE_API_BASE_URL}/checkout`)
    ).json()
  } catch (e) {
    console.error(e)
  }
}
fetchData()

const inputClasses =
  'text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400'

const makePayment = async () => {
  try {
    const flash = await (
      await fetch(`${import.meta.env.VITE_API_BASE_URL}/make-payment`, {
        headers: { 'Content-Type': 'application/json' },
        method: 'POST',
      })
    ).json()
    toast.success(flash.message)
    await router.push({ name: 'HOME' })
  } catch (e) {
    console.error(e)
  }
}
</script>
