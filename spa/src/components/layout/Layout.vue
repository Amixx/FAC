<template>
  <div
    class="bg-slate-100 flex flex-col items-center justify-center m-auto max-w-screen-2xl"
  >
    <PageHeader />
    <main class="bg-white container min-h-[calc(100vh-64px)]">
      <router-view v-if="!pageDataLoading && pageData" :data="pageData" />
      <Spinner v-else-if="pageDataLoading" />
      <p v-else class="text-red-700">Notika neparedzēta kļūda!</p>
    </main>
    <PageFooter
      v-if="!footerDataLoading && globalData"
      :data="globalData.footer"
    />
    <Spinner v-else-if="footerDataLoading" />
    <p v-else class="text-red-700">Notika neparedzēta kļūda!</p>
  </div>
</template>

<script setup lang="ts">
import PageHeader from './PageHeader.vue'
import PageFooter from './PageFooter.vue'
import DataRepository from '@/repositories/DataRepository'
import { ref, watchEffect } from 'vue'
import { useRoute } from 'vue-router'
import Spinner from '@/components/Spinner.vue'
import { routeNameToPageIndex } from '@/router'
import { useHead } from '@unhead/vue'

const route = useRoute()

const pageData = ref<Page | null>(null)
const pageDataLoading = ref(false)

const globalData = ref<Exclude<Data, 'pages'> | null>(null)
const footerDataLoading = ref(false)

watchEffect(async () => {
  pageDataLoading.value = true
  pageData.value = null
  const index = routeNameToPageIndex(route.name)
  if (index === -1) return
  try {
    pageData.value = await DataRepository.getPageData(index)
    useHead({
      title: pageData.value.title,
      meta: [
        { name: 'description', content: pageData.value.metaDescription },
        { name: 'keywords', content: pageData.value.metaKeywords },
      ],
    })
  } catch (e) {
    console.error(e)
  } finally {
    pageDataLoading.value = false
  }
})
;(async () => {
  footerDataLoading.value = true
  globalData.value = null
  try {
    globalData.value = await DataRepository.getGlobalData()
  } catch (e) {
    console.error(e)
  } finally {
    footerDataLoading.value = false
  }
})()
</script>
