<template>
  <div v-if="data" class="container mx-auto px-4 py-12">
    <div class="gap-12 grid grid-cols-1 md:grid-cols-2">
      <div class="flex flex-col space-y-4">
        <!-- Main Product Image -->
        <img
          :alt="data.product.title"
          class="h-96 object-cover rounded-lg shadow-lg w-full"
          :src="data.product.images[0]"
        />

        <!-- Additional Images Carousel -->
        <div class="flex hide-scroll-bar overflow-x-scroll">
          <div class="flex flex-nowrap">
            <img
              v-for="image in data.product.images"
              :key="image"
              :alt="`${data.product.title} image`"
              class="h-24 inline-block mr-2 rounded-lg shadow"
              :src="image"
            />
          </div>
        </div>
      </div>

      <div>
        <h1 class="font-bold text-3xl">{{ data.product.title }}</h1>
        <span
          v-if="data.product.category"
          class="font-semibold text-gray-500 text-sm"
          >{{ data.product.category.name }}</span
        >
        <div class="mt-4">
          <span class="font-semibold text-2xl text-gray-800"
            >${{ data.product.priceWithDiscount.toFixed(2) }}</span
          >
          <span
            v-if="data.product.discount"
            class="line-through ml-2 text-gray-500"
            >${{ data.product.price }}</span
          >
        </div>
        <p class="mt-4 text-gray-700">{{ data.product.description }}</p>

        <div class="mt-4">
          <span class="font-semibold text-gray-700"
            >Popularitāte: {{ data.product.popularity }}</span
          >
        </div>

        <button
          class="bg-purple-500 duration-300 hover:bg-purple-600 mt-6 px-6 py-2 rounded text-white transition"
        >
          Ielikt grozā
        </button>

        <!-- Creation Date -->
        <p class="mt-4 text-gray-400 text-xs">
          Pievienots
          {{ new Date(data.product.createdAt).toLocaleDateString('lv-LV') }}
        </p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { ProductPageData } from '@/types/Data'
import { watch } from 'vue'

const route = useRoute()

const id = computed(() => parseInt(route.params.id as string) as number)

const { data, refresh } = await useFetch<ProductPageData>(
  () => `/product/${id.value}`,
  { baseURL: import.meta.env.VITE_API_BASE_URL },
)

watch(id, () => refresh())
</script>
