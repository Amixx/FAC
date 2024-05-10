<template>
  <li
    class="bg-white border flex flex-col justify-between leading-normal p-4 rounded-lg shadow-lg"
  >
    <div class="mb-4">
      <div class="flex gap-2 items-center justify-between mb-2">
        <div class="text-sm">
          <p class="text-gray-500">
            Publicēts:
            {{ new Date(post.createdAt).toLocaleDateString('lv-LV') }}
          </p>
          <p>Patīk: {{ post.postLikes.length }}</p>
        </div>
        <NuxtLink :to="`/user/${post.author.id}`">
          <img
            alt="avatar"
            class="h-10 rounded-full w-10"
            :src="post.author.avatar"
          />
        </NuxtLink>
      </div>
      <p class="mb-2 text-gray-900 whitespace-break-spaces">
        {{ post.content }}
      </p>
      <div
        v-if="post.repostedPost"
        class="border-t border-t-slate-200 mt-4 pt-4"
      >
        <p>Oriģinālā ziņa:</p>
        <p class="text-gray-500 text-sm">
          {{ post.repostedPost.content }}
        </p>
      </div>
    </div>
    <div class="flex flex-col gap-1">
      <div class="flex gap-2">
        <button
          class="border font-bold px-2 py-1 rounded text-red-700 w-full"
          @click="toggleLike"
        >
          {{ isLikedByCurrentUser ? '💚' : '🩶' }}
        </button>
        <NuxtLink
          class="border font-bold px-2 py-1 rounded text-emerald-500 w-full"
          :to="`/new-post/${post.id}`"
        >
          Pārpublicēt
        </NuxtLink>
      </div>
      <button
        v-if="isPostAuthoredByUser(post, currentUser)"
        class="border font-bold px-2 py-1 rounded text-red-700 w-full"
        @click="deletePost"
      >
        Dzēst
      </button>
    </div>
  </li>
</template>

<script setup lang="ts">
import type { Post } from '@/types/Data'
import {
  isPostAuthoredByUser,
  isPostLikedByUser,
  parseErrorAndShowMessage,
} from '@/helpers/global'
import { toast } from 'vue3-toastify'
import { currentUser } from '@/stores/globalStore'

const props = defineProps<{ post: Post }>()

const isLikedByCurrentUser = ref(
  isPostLikedByUser(props.post, currentUser.value),
)
const toggleLike = async () => {
  try {
    const flash = await $fetch<{ type: string; message: string }>(
      `${import.meta.env.VITE_API_BASE_URL}/posts/toggle-like`,
      {
        method: 'POST',
        body: JSON.stringify({
          id: props.post.id,
          userId: currentUser.value?.id,
        }),
      },
    )
    toast.success(flash.message)
    isLikedByCurrentUser.value = !isLikedByCurrentUser.value
  } catch (e) {
    console.error(e)
    parseErrorAndShowMessage(e)
  }
}

const deletePost = async () => {
  try {
    const flash = await $fetch<{ type: string; message: string }>(
      `${import.meta.env.VITE_API_BASE_URL}/posts/delete`,
      {
        method: 'POST',
        body: JSON.stringify({
          id: props.post.id,
          userId: currentUser.value?.id,
        }),
      },
    )
    toast.success(flash.message)
  } catch (e) {
    console.error(e)
    parseErrorAndShowMessage(e)
  }
}
</script>
