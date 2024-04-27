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
        <p class="max-w-3xl mt-6 text-white text-xl">{{ data.content }}</p>
      </div>
    </div>
    <section class="px-6 py-12">
      <div class="gap-4 grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2">
        <div class="bg-white overflow-hidden p-6 rounded shadow-lg">
          <h2 class="font-bold mb-2 text-xl">E-pasts</h2>
          <p class="text-base text-gray-700">
            <a
              class="hover:text-blue-700 text-blue-500"
              :href="'mailto:' + data.contact_info.email"
              >{{ data.contact_info.email }}</a
            >
          </p>
        </div>
        <div class="bg-white overflow-hidden p-6 rounded shadow-lg">
          <h2 class="font-bold mb-2 text-xl">Telefons</h2>
          <p class="text-base text-gray-700">
            <a
              class="hover:text-blue-700 text-blue-500"
              :href="'tel:' + data.contact_info.phone"
              >{{ data.contact_info.phone }}</a
            >
          </p>
        </div>
        <div class="bg-white overflow-hidden p-6 rounded shadow-lg">
          <h2 class="font-bold mb-2 text-xl">Adrese</h2>
          <p class="text-base text-gray-700">
            <a
              class="hover:text-blue-700 text-blue-500"
              :href="`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(data.contact_info.address)}`"
              target="_blank"
              >{{ data.contact_info.address }}</a
            >
          </p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
const route = useRoute()

const data = computed(() => route.meta.data as ContactsPage)

useHead({
  title: data.value.title,
  meta: [
    { name: 'title', content: data.value.title },
    { name: 'description', content: data.value.metaDescription },
    { name: 'keywords', content: data.value.metaKeywords },
  ],
})
</script>
