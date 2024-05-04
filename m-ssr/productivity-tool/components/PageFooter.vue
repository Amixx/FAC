<template>
  <footer class="bg-white container text-sm">
    <div class="flex gap-4 justify-between p-4 text-white">
      <div>© {{ currentYear }} Mērķu Meistars</div>
    </div>
    <div
      class="bg-black border-slate-200 flex justify-between px-2 py-1 text-[10px] text-white"
    >
      <div>
        Made with ❤️ by
        <a
          class="hover:underline text-orange-300"
          href="https://github.com/Amixx"
          target="_blank"
          >https://github.com/Amixx</a
        >
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
const currentYear = new Date().getFullYear()
</script>
