<template>
  <div
    class="bg-slate-100 flex flex-col items-center justify-center m-auto max-w-screen-2xl min-h-screen"
  >
    <PageHeader />
    <main class="bg-white container">
      <slot></slot>
    </main>
    <PageFooter :data="footerData" />
  </div>
</template>

<script setup lang="ts">
defineProps<{ footerData: FooterData }>()
</script>
