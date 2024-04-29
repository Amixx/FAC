<template>
  <div>
    <div class="relative">
      <img
        alt="hero"
        class="absolute h-full inset-0 object-cover w-full"
        :src="data.images[0].mob"
        :srcset="`${data.images[0].mob} 320w, ${data.images[0].desk}`"
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
    <div class="container lg:px-8 mx-auto px-4 py-8 sm:px-6">
      <div class="gap-4 grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2">
        <div
          v-for="(offer, index) in data.offers"
          :key="index"
          class="flex flex-col overflow-hidden rounded shadow-lg"
        >
          <div class="h-40 overflow-hidden relative">
            <img
              :alt="offer.title"
              class="h-full object-cover w-full"
              :src="offer.image.mob"
              :srcset="`${offer.image.mob} 320w, ${offer.image.desk}`"
            />
            <div class="absolute bg-black inset-0 opacity-70"></div>
            <div
              class="-translate-x-1/2 -translate-y-1/2 absolute font-bold left-1/2 text-white text-xl top-1/2"
            >
              {{ offer.title }}
            </div>
          </div>
          <div class="px-6 py-4">
            <div class="font-bold mb-2 text-xl">{{ offer.title }}</div>
            <p class="text-base text-gray-700">{{ offer.description }}</p>
          </div>
          <div class="flex flex-col grow justify-end pb-4 px-6">
            <div class="flex gap-2 items-center justify-between">
              <span
                class="bg-gray-200 font-semibold px-3 py-1 rounded-full text-gray-700 text-sm"
                >Sākot no: {{ offer.starting_price }} EUR</span
              >
              <button
                class="bg-yellow-700 font-bold hover:bg-yellow-600 px-4 py-2 rounded text-white"
              >
                Uzzināt vairāk
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps<{ data: OffersPage }>()
</script>
