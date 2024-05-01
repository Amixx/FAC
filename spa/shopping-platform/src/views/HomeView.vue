<template>
  <div v-if="data" class="pb-16">
    <div class="relative">
      <img
        alt="Banner"
        class="h-[450px] object-cover sm:h-96 w-full"
        :src="data.images.mob"
        :srcset="`${data.images.mob} 360w, ${data.images.desk}`"
      />
      <div
        class="absolute bg-black bg-opacity-50 bottom-0 flex items-center justify-center left-0 right-0 top-0"
      >
        <div class="text-center">
          <h1 class="font-bold mb-4 sm:text-4xl text-white text-xl">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </h1>
          <div class="flex">
            <div class="max-w-md mb-6 mx-auto sm:text-lg text-white">
              <p class="mb-4">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi
                atque autem blanditiis ducimus eligendi id numquam tempora!
                Aperiam, distinctio, velit. Architecto atque delectus error
                magni odit quae, ratione sunt voluptatibus!
              </p>
              <router-link
                class="bg-white font-semibold hover:bg-gray-200 px-8 py-3 rounded text-black text-sm"
                :to="{ name: 'CATALOGUE' }"
              >
                Apskatīt
              </router-link>
            </div>
            <div class="max-w-md mb-6 mx-auto sm:text-lg text-white">
              <p class="mb-4">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Accusantium amet doloribus, facilis iusto laborum, laudantium
                maiores necessitatibus, nesciunt numquam possimus quasi
                recusandae rerum totam vero.
              </p>
              <router-link
                class="bg-white font-semibold hover:bg-gray-200 px-8 py-3 rounded text-black text-sm"
                :to="{ name: 'CATALOGUE' }"
              >
                Apskatīt
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-16 text-center">
      <h2 class="font-bold mb-4 text-3xl">Jaunākie produkti</h2>
      <div class="flex flex-wrap gap-4 justify-center">
        <ProductCard
          v-for="product in data.newProducts"
          :key="product.id"
          :product="product"
        />
      </div>
    </div>

    <div class="mt-16 text-center">
      <h2 class="font-bold mb-4 text-3xl">Populārākie produkti</h2>
      <div class="flex flex-wrap gap-4 justify-center">
        <ProductCard
          v-for="product in data.popularProducts"
          :key="product.id"
          :product="product"
        />
      </div>
    </div>

    <div class="mt-16 text-center">
      <h2 class="font-bold mb-4 text-3xl">Produkti ar atlaidēm</h2>
      <div class="flex flex-wrap gap-4 justify-center">
        <ProductCard
          v-for="product in data.productsWithDiscounts"
          :key="product.id"
          :product="product"
        />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import ProductCard from '@/components/ProductCard.vue'
import type { HomePageData } from '@/types/Data'
import { ref } from 'vue'
import { useHead } from '@unhead/vue'

const data = ref<HomePageData>()

const fetchData = async () => {
  try {
    data.value = await (
      await fetch(`${import.meta.env.VITE_API_BASE_URL}/home`)
    ).json()
    if (!data.value) return
    useHead({
      title: data.value.metadata.title,
      meta: [
        { name: 'description', content: data.value.metadata.metaDescription },
        { name: 'keywords', content: data.value.metadata.metaKeywords },
      ],
    })
  } catch (e) {
    console.error(e)
  }
}
fetchData()
</script>
