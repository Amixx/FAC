<template>
  <router-link
    class="bg-white block max-w-sm overflow-hidden relative rounded shadow-lg"
    :to="`/product/${product.id}`"
  >
    <!-- Product Image -->
    <img
      :alt="product.title"
      class="h-48 object-cover w-full"
      :src="product.images[0]"
    />

    <!-- Category Badge on Top of Image -->
    <div
      v-if="product.category"
      class="absolute bg-purple-500 font-bold left-0 px-3 py-1 rounded-br-lg text-white text-xs top-0 uppercase"
    >
      {{ product.category.name }}
    </div>

    <!-- Product Details -->
    <div class="px-6 py-4">
      <div class="font-bold mb-2 text-xl">{{ product.title }}</div>
      <p class="mb-4 text-base text-gray-700">
        {{ product.description.substring(0, 80) }}...
      </p>
      <div class="flex items-center justify-between">
        <span class="font-bold text-lg">
          ${{ product.priceWithDiscount.toFixed(2) }}
          <span
            v-if="product.priceWithDiscount !== product.price"
            class="line-through ml-2 text-gray-500 text-sm"
            >${{ product.price }}</span
          >
        </span>
        <button
          class="bg-purple-500 duration-300 ease-in-out font-bold hover:-translate-y-1 hover:bg-purple-700 px-4 py-2 rounded text-white transform transition"
          :disabled="addingToCart"
          @click.stop.prevent="addToCart(product.id)"
        >
          Ielikt grozā
        </button>
      </div>
    </div>
  </router-link>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import type { Product } from '@/types/Data'
import { toast } from 'vue3-toastify'

defineProps<{ product: Product }>()

const addingToCart = ref(false)
const addToCart = async (productId: number) => {
  try {
    await fetch(`${import.meta.env.VITE_API_BASE_URL}/add-to-cart`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ productId }),
    })
    toast.success('Produkts pievienots grozam!')
  } catch (e) {
    console.error(e)
  } finally {
    addingToCart.value = false
  }
}
</script>
