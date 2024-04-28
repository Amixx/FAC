<template>
  <NuxtLayout>
    <NuxtPage
      v-if="!pageDataLoading && pageData"
      :key="route.path"
      :data="pageData"
    />
    <Spinner v-else-if="pageDataLoading" />
    <p v-else class="text-red-700">Notika neparedzēta kļūda!</p>
  </NuxtLayout>
</template>

<script setup lang="ts">
import { routeNameToPageIndex } from '~/routerHelper'

const route = useRoute()

const index = computed(() => routeNameToPageIndex(route.name))

const { data: pageData, pending: pageDataLoading } = await useFetch<Page>(
  () => `/pages/${index.value}`,
  { baseURL: import.meta.env.VITE_API_BASE_URL },
)

watch(
  pageData,
  (n) => {
    if (!n) return
    useHead({
      title: n.title,
      meta: [
        { name: 'description', content: n.metaDescription },
        { name: 'keywords', content: n.metaKeywords },
      ],
    })
  },
  { immediate: true },
)
</script>
