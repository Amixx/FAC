<template>
  <div
    v-if="data"
    class="container flex gap-8 items-center justify-center p-10"
  >
    <div class="w-2/3">
      <iframe
        allowfullscreen
        class="w-full"
        frameborder="0"
        height="400"
        :src="`https://www.youtube.com/embed/${data.video.youtubeId}`"
      ></iframe>
    </div>
    <div class="w-1/3">
      <div class="mb-4">
        <p class="font-semibold text-xl">{{ data.video.title }}</p>
        <p class="text-gray-500">
          Publicēts:
          {{ new Date(data.video.createdAt).toLocaleDateString('lv-LV') }}
        </p>
      </div>
      <div>
        <p class="text-gray-700">{{ data.video.description }}</p>
      </div>
    </div>
  </div>
  <div v-if="data" class="flex gap-4 p-10">
    <VideoCard
      v-for="video in data.relatedVideos"
      :key="video.id"
      :video="video"
    />
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import type { VideoPageData } from '@/types/Data'
import VideoCard from '@/components/VideoCard.vue'

const props = defineProps<{ id: number }>()

const data = ref<VideoPageData>()
const loadData = async () => {
  try {
    data.value = await (
      await fetch(`${import.meta.env.VITE_API_BASE_URL}/video/${props.id}`, {
        headers: { 'Content-Type': 'application/json' },
      })
    ).json()
  } catch (e) {
    console.error(e)
  }
}
loadData()
</script>
