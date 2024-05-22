<template>
  <div class="container mx-auto p-4">
    <h1 class="mb-4">
      <span class="font-bold text-2xl text-gray-800">Videoklipu katalogs</span>
    </h1>
    <ul
      v-if="data"
      class="gap-4 grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4"
    >
      <VideoCard v-for="video in data.videos" :key="video.id" :video="video" />
      <li v-if="data.videos.length === 0">
        <div class="bg-white p-4 rounded-lg shadow-lg">
          <p>Netika atrasts neviens videoklips.</p>
        </div>
      </li>
      <li v-if="data.videos.length > 0 && data.hasMoreItems">
        <button
          class="bg-white flex flex-col justify-between leading-normal mt-4 p-4 rounded-lg shadow-lg w-full"
        >
          <span class="font-bold text-sm">
            <button
              class="hover:text-gray-700 hover:underline text-red-500"
              @click="loadMoreItems"
            >
              Ielādēt vēl
            </button>
          </span>
        </button>
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { parseErrorAndShowMessage } from '@/helpers/global'
import type { HomePageData } from '~/types/Data'
import VideoCard from '~/components/VideoCard.vue'

const lastPage = ref(1)

const { data } = useFetch<HomePageData>(
  () => {
    const url = new URL(
      `${import.meta.env.VITE_API_BASE_URL}/videos`,
      import.meta.env.VITE_API_BASE_URL,
    )
    url.searchParams.set('lastPage', lastPage.value.toString())
    return url.toString()
  },
  { onRequestError: parseErrorAndShowMessage },
)

const loadMoreItems = () => lastPage.value++
</script>
