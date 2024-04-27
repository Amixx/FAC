<template>
  <PageHeader />
  <main class="bg-white container">
    <router-view />
  </main>
  <PageFooter :data="footerData" />
</template>

<script setup lang="ts">
import PageHeader from './PageHeader.vue'
import PageFooter from './PageFooter.vue'

defineProps<{ footerData: FooterData }>()
</script>
