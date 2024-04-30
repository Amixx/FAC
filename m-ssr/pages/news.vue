<template>
  <div>
    <div class="relative">
      <img
        alt="hero"
        class="absolute h-full inset-0 object-cover w-full"
        :src="data.images[0].mob"
        :srcset="`${data.images[0].mob} 360w, ${data.images[0].desk}`"
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
        <p class="max-w-3xl mt-6 text-white text-xl">{{ data.content }}</p>
      </div>
    </div>
    <div
      v-for="(item, index) in data.news_items"
      :key="index"
      class="flex flex-wrap"
      :class="index % 2 === 0 ? 'flex-row' : 'flex-row-reverse'"
    >
      <div class="overflow-hidden rounded sm:w-1/2 w-full">
        <img
          :alt="item.title"
          class="h-64 object-cover rounded w-full"
          :src="item.image.mob"
          :srcset="`${item.image.mob} 360w, ${item.image.desk}`"
        />
      </div>
      <div class="p-4 pt-0 sm:w-1/2 w-full">
        <div class="flex justify-between">
          <h2 class="font-bold mb-2 text-2xl">{{ item.title }}</h2>
          <span class="text-gray-600 text-sm">{{ item.date }}</span>
        </div>
        <p>{{ item.description }}</p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps<{ data: NewsPage }>()
</script>
