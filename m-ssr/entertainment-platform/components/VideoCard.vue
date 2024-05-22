<template>
  <li
    class="bg-gradient-to-r border border-gray-300 flex flex-col from-blue-600/75 hover:scale-105 justify-between leading-relaxed p-6 rounded-xl shadow-xl to-red-600/75 transform transition-transform"
  >
    <NuxtLink class="cursor-pointer" :to="`/video/${video.id}`">
      <div class="flex gap-4 items-center justify-between mb-4">
        <div class="text-white text-xs">
          <p class="italic">
            Publicēts:
            {{ new Date(video.createdAt).toLocaleDateString('lv-LV') }}
          </p>
        </div>
      </div>
      <p class="font-semibold mb-2 text-white text-xl">{{ video.title }}</p>
      <p class="mb-4 text-white">{{ video.description }}</p>
      <img
        :alt="video.title"
        class="h-auto rounded-lg shadow-md w-full"
        :src="`http://img.youtube.com/vi/${video.youtubeId}/0.jpg`"
      />
    </NuxtLink>
  </li>
</template>

<script setup lang="ts">
import type { Video } from '@/types/Data'

defineProps<{ video: Video }>()
</script>
