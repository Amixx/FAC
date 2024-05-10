<template>
  <div v-if="data" class="container mx-auto">
    <div class="flex flex-wrap my-4 shadow-md">
      <div class="bg-white p-4 sm:p-10 sm:w-3/4">
        <div class="border-b flex justify-between pb-8">
          <h1 class="font-semibold text-2xl">Iepirkumu grozs</h1>
          <h2 class="font-semibold text-2xl">
            {{ data.order.orderItems.length }} produkti
          </h2>
        </div>
        <div class="flex mb-5 mt-10">
          <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">
            Produkts
          </h3>
          <h3
            class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5"
          >
            Skaits
          </h3>
          <h3
            class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5"
          >
            Cena
          </h3>
          <h3
            class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5"
          >
            Kopā
          </h3>
          <h3
            class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5"
          >
            Noņemt
          </h3>
        </div>
        <div
          v-for="item in data.order.orderItems"
          :key="item.id"
          class="-mx-8 flex hover:bg-gray-100 items-center px-2 py-1.5 sm:px-6 sm:py-5"
        >
          <div class="flex w-2/5">
            <div class="hidden sm:block w-20">
              <img
                :alt="item.product.title"
                class="h-24"
                :src="item.product.images[0]"
              />
            </div>
            <div class="flex flex-col flex-grow justify-between ml-4">
              <span class="font-bold text-sm">{{ item.product.title }}</span>
              <span class="text-gray-500 text-xs">{{
                item.product.category.name
              }}</span>
            </div>
          </div>
          <div class="w-1/5">
            <input
              v-model.number="item.amount"
              class="mx-2 text-center w-8"
              min="1"
              type="number"
            />
            <button
              class="hover:text-purple-500 text-gray-600 transform"
              @click="updateCartItem(item)"
            >
              Saglabāt
            </button>
          </div>
          <span class="font-semibold text-center text-sm w-1/5"
            >${{ item.product.price }}</span
          >
          <span class="font-semibold text-center text-sm w-1/5"
            >${{
              (item.amount * parseFloat(item.product.price)).toFixed(2)
            }}</span
          >
          <button
            class="hover:scale-110 transform w-4"
            @click="removeCartItem(item.id)"
          >
            ❌
          </button>
        </div>
      </div>
      <div id="summary" class="px-8 py-10 sm:w-1/4">
        <h1 class="border-b font-semibold pb-8 text-2xl">
          Pasūtījuma pārskats
        </h1>
        <div class="flex justify-between mb-5 mt-10">
          <span class="font-semibold text-sm uppercase"
            >{{ data.order.orderItems.length }} produkti</span
          >
          <span class="font-semibold text-sm"
            >${{ data.order.totalPrice.toFixed(2) }}</span
          >
        </div>
        <div class="flex gap-2 py-10">
          <NuxtLink
            class="bg-gray-500 hover:bg-gray-600 px-5 py-2 text-sm text-white uppercase"
            to="/catalogue"
          >
            Turpināt iepirkties
          </NuxtLink>
          <NuxtLink
            class="bg-purple-500 hover:bg-purple-600 px-5 py-2 text-sm text-white uppercase"
            :to="{ name: 'checkout' }"
          >
            Apmaksāt pasūtījumu
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { CartPageData, OrderItem } from '@/types/Data'
import { toast } from 'vue3-toastify'

const { data, refresh } = await useFetch<CartPageData>('/cart', {
  baseURL: import.meta.env.VITE_API_BASE_URL,
})

watchEffect(() => {
  if (!data.value) return
  useHead({
    title: data.value.metadata.title,
    meta: [
      { name: 'description', content: data.value.metadata.metaDescription },
      { name: 'keywords', content: data.value.metadata.metaKeywords },
    ],
  })
})

const updateCartItem = async (item: OrderItem) => {
  try {
    const flash = await $fetch<{ type: string; message: string }>(
      `${import.meta.env.VITE_API_BASE_URL}/update-cart-item`,
      {
        method: 'POST',
        body: JSON.stringify({ cartItemId: item.id, amount: item.amount }),
        headers: { 'Content-Type': 'application/json' },
      },
    )
    toast.success(flash.message)
  } catch (e) {
    console.error(e)
  }
}

const removeCartItem = async (cartItemId: number) => {
  try {
    const flash = await $fetch<{ type: string; message: string }>(
      `${import.meta.env.VITE_API_BASE_URL}/remove-cart-item`,
      {
        method: 'POST',
        body: JSON.stringify({ cartItemId }),
        headers: { 'Content-Type': 'application/json' },
      },
    )
    toast.success(flash.message)
    await refresh()
  } catch (e) {
    console.error(e)
  }
}
</script>
