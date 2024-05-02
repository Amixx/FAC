<template>
  <div v-if="data && !('redirect' in data)" class="container mx-auto px-4 py-8">
    <div class="-mx-4 flex flex-wrap">
      <!-- Sidebar for Filters -->
      <div class="mb-4 md:mb-0 md:w-1/4 px-4 w-full">
        <div class="bg-white p-3 rounded-lg shadow-lg">
          <h3 class="font-bold mb-4 text-xl">Filtri</h3>
          <form>
            <label
              class="block font-bold mb-2 text-gray-700 text-sm"
              for="categoryFilter"
            >
              Kategorija
            </label>
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
          </form>
        </div>
      </div>

      <!-- Products Grid -->
      <div class="md:w-3/4 px-4 w-full">
        <div>
          <div class="flex gap-4 justify-center mb-4">
            <NuxtLink
              v-if="data.prevPageData"
              class="bg-gray-500 hover:bg-gray-600 px-5 py-2 text-sm text-white uppercase"
              :to="
                createCatalogueRoute(
                  data.prevPageData.page,
                  data.prevPageData.category,
                )
              "
            >
              Iepriekšējā lapa
            </NuxtLink>
            <span
              class="bg-gray-100 flex h-10 items-center justify-center rounded-full w-10"
              >{{ data.page }}</span
            >
            <NuxtLink
              v-if="data.nextPageData"
              class="bg-gray-500 hover:bg-gray-600 px-5 py-2 text-sm text-white uppercase"
              :to="
                createCatalogueRoute(
                  data.nextPageData.page,
                  data.nextPageData.category,
                )
              "
            >
              Nākamā lapa
            </NuxtLink>
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
import ProductCard from '~/components/ProductCard.vue'
import type { CataloguePageData } from '~/types/Data'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useHead } from '@unhead/vue'

const router = useRouter()
const route = useRoute()

const page = computed(() =>
  route.params.page ? parseInt(route.params.page as string) : 1,
)
const category = computed(() => route.query.category as string | null)

const selectedCategory = ref(category.value)

watch(selectedCategory, () => {
  router.push(createCatalogueRoute(page.value, selectedCategory.value))
})

const createCatalogueRoute = (page: number, category?: string | null) => {
  let route = `/catalogue/${page}`
  if (category) route += `?category=${encodeURIComponent(category)}`
  return route
}

const url = computed(() =>
  createCatalogueRoute(page.value, selectedCategory.value),
)

const { data } = await useFetch<CataloguePageData>(() => url.value, {
  baseURL: import.meta.env.VITE_API_BASE_URL,
})

watchEffect(() => {
  if (!data.value) return
  if ('redirect' in data.value) {
    return router.replace(
      createCatalogueRoute(
        data.value.redirect.page,
        data.value.redirect.category,
      ),
    )
  }

  useHead({
    title: data.value.metadata.title,
    meta: [
      { name: 'description', content: data.value.metadata.metaDescription },
      { name: 'keywords', content: data.value.metadata.metaKeywords },
    ],
  })
  selectedCategory.value = data.value.selectedCategory
})
</script>
