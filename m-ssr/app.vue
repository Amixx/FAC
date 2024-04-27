<template>
  <NuxtLayout :footer-data="data.footer">
    <NuxtPage />
  </NuxtLayout>
</template>

<script setup lang="ts">
import importedData from './data/data.json'

const route = useRoute()

const data = importedData as Data
</script>
