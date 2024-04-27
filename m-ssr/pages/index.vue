<template>
  <div>
    <div class="relative">
      <img
        alt="hero"
        class="absolute h-full inset-0 object-cover w-full"
        :src="data.images[0]"
      />
      <div class="absolute bg-black inset-0 opacity-70"></div>
      <div
        class="lg:px-8 max-w-7xl mx-auto px-4 py-24 relative sm:px-6 sm:py-32"
      >
        <h1
          class="font-extrabold lg:text-6xl sm:text-5xl text-4xl text-white tracking-tight"
        >
          {{ data.title }}
        </h1>
        <p class="max-w-3xl mt-6 text-white text-xl">{{ data.content[0] }}</p>
      </div>
    </div>
    <section class="body-font text-gray-600">
      <p class="font-semibold mx-10 my-6 text-lg">{{ data.content[1] }}</p>
      <div class="mx-auto px-5 py-20">
        <div class="flex h-48 overflow-auto rounded">
          <img
            v-for="i in 10"
            :key="i"
            alt="gallery"
            class="object-center object-cover w-48"
            :src="data.images[1]"
          />
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
const route = useRoute()

const data = computed(() => route.meta.data as Page)
</script>
