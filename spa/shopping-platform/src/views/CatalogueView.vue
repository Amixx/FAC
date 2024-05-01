<template>
  <div v-if="data && !('redirect' in data)" class="container mx-auto px-4 py-8">
    <div class="-mx-4 flex flex-wrap">
      <!-- Sidebar for Filters -->
      <div class="mb-4 md:mb-0 md:w-1/4 px-4 w-full">
        <div class="bg-white p-3 rounded-lg shadow-lg">
          <h3 class="font-bold mb-4 text-xl">Filtri</h3>
          <form @submit.prevent="changeCategory">
            <label
              class="block font-bold mb-2 text-gray-700 text-sm"
              for="categoryFilter"
              >Kategorija</label
            >
            <select
              id="categoryFilter"
              v-model="selectedCategory"
              class="appearance-none bg-gray-200 block border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none leading-tight pr-8 px-4 py-3 rounded text-gray-700 w-full"
            >
              <option :value="null">Visas kategorijas</option>
              <option
                v-for="cat in data.categories"
                :key="cat.id"
                :value="cat.name"
              >
                {{ cat.name }}
              </option>
            </select>
            <button
              class="bg-purple-500 duration-300 ease-in-out font-bold hover:-translate-y-1 hover:bg-purple-700 mt-4 px-4 py-2 rounded text-white transform transition"
              type="submit"
            >
              Lietot
            </button>
          </form>
        </div>
      </div>

      <!-- Products Grid -->
      <div class="md:w-3/4 px-4 w-full">
        <div>
          <div class="flex gap-4 justify-center mb-4">
            <router-link
              v-if="data.prevPageData"
              class="bg-gray-500 hover:bg-gray-600 px-5 py-2 text-sm text-white uppercase"
              :to="{
                name: 'CATALOGUE',
                params: { page: data.prevPageData.page },
                query: { category: data.prevPageData.category },
              }"
            >
              Iepriekšējā lapa
            </router-link>
            <span
              class="bg-gray-100 flex h-10 items-center justify-center rounded-full w-10"
              >{{ data.page }}</span
            >
            <router-link
              v-if="data.nextPageData"
              class="bg-gray-500 hover:bg-gray-600 px-5 py-2 text-sm text-white uppercase"
              :to="{
                name: 'CATALOGUE',
                params: { page: data.nextPageData.page },
                query: { category: data.nextPageData.category },
              }"
            >
              Nākamā lapa
            </router-link>
          </div>
        </div>

        <div class="gap-6 grid grid-cols-1 lg:grid-cols-3 sm:grid-cols-2">
          <ProductCard
            v-for="product in data.products"
            :key="product.id"
            :product="product"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import ProductCard from '@/components/ProductCard.vue'
import type { CataloguePageData } from '@/types/Data'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useHead } from '@unhead/vue'

const props = defineProps<{ page: number; category?: string }>()
const router = useRouter()

const data = ref<CataloguePageData>()
const selectedCategory = ref(props.category)

const fetchData = async () => {
  try {
    const url = new URL(
      `${import.meta.env.VITE_API_BASE_URL}/catalogue/${props.page}`,
    )
    if (props.category) url.searchParams.set('category', props.category)
    data.value = await (await fetch(url.toString())).json()

    if (!data.value) return
    if ('redirect' in data.value) {
      return router.replace({
        name: router.currentRoute.value.name as RouteRecordName,
        params: { page: data.value.redirect.page },
        query: { category: data.value.redirect.category },
      })
    }

    useHead({
      title: data.value.metadata.title,
      meta: [
        { name: 'description', content: data.value.metadata.metaDescription },
        { name: 'keywords', content: data.value.metadata.metaKeywords },
      ],
    })
    selectedCategory.value = data.value.selectedCategory
  } catch (e) {
    console.error(e)
  }
}
fetchData()

const changeCategory = () => {
  router.push({
    ...router.currentRoute.value,
    query: { category: selectedCategory.value },
  })
}
</script>
