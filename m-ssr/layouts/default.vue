<template>
  <div
    class="bg-slate-100 flex flex-col items-center justify-center m-auto max-w-screen-2xl"
  >
    <PageHeader />
    <main class="bg-white container min-h-[calc(100vh-64px)]">
      <slot></slot>
    </main>
    <PageFooter
      v-if="!footerDataLoading && globalData"
      :data="globalData.footer"
    />
  </div>
</template>

<script setup lang="ts">
const { data: globalData, pending: footerDataLoading } = await useFetch<
  Exclude<Data, 'pages'>
>('/global', {
  baseURL: import.meta.env.VITE_API_BASE_URL,
})
</script>
