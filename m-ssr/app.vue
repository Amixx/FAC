<template>
  <NuxtLayout :footer-data="data.footer">
    <NuxtPage />
  </NuxtLayout>
</template>

<script setup lang="ts">
import importedData from './data/data.json'

const data = importedData as Data
</script>
