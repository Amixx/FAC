<template>
  <div class="container mx-auto p-4">
    <h1 class="mb-4">
      <span class="font-bold text-2xl text-gray-800">Videoklipu katalogs</span>
    </h1>
    <ul
      v-if="data"
      class="gap-4 grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4"
    >
      <li v-for="video in data.videos" :key="video.id">
        <VideoCard :video="video" />
      </li>
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
import VideoCard from '@/components/VideoCard.vue'
import type { HomePageData } from '@/types/Data'
import { parseErrorAndShowMessage } from '@/helpers/global'

const data = ref<HomePageData>()

let lastPage = 1

const fetchData = async () => {
  try {
    const url = new URL(
      `${import.meta.env.VITE_API_BASE_URL}/videos`,
      import.meta.env.VITE_API_BASE_URL,
    )
    url.searchParams.set('lastPage', lastPage.toString())

    data.value = await (await fetch(url.toString())).json()
  } catch (e) {
    console.error(e)
    parseErrorAndShowMessage(e)
  }
}
fetchData()

const loadMoreItems = async () => {
  lastPage++
  await fetchData()
}
</script>
