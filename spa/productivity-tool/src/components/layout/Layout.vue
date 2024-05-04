<template>
  <div
    class="bg-slate-100 flex flex-col items-center justify-center m-auto max-w-screen-2xl"
  >
    <PageHeader />
    <main class="bg-white container min-h-[calc(100vh-64px)]">
      <router-view :key="route.fullPath" />
    </main>
    <PageFooter />
  </div>
</template>

<script setup lang="ts">
import PageHeader from './PageHeader.vue'
import PageFooter from './PageFooter.vue'
import { useRoute } from 'vue-router'

const route = useRoute()
</script>
