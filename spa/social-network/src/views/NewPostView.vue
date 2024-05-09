<template>
  <div class="container min-h-screen mx-auto p-4">
    <h1 class="flex gap-4 items-center justify-between mb-4">
      <span class="font-bold text-2xl text-gray-800">Jauna ziņa</span>
    </h1>
    <div class="mt-6">
      <div
        v-if="repostedPost"
        class="bg-blue-100 border-blue-500 border-l-4 p-4 text-blue-700"
        role="alert"
      >
        <p class="font-bold">
          Jūs pārpublicējat ierakstu: "{{
            repostedPost.content.substring(0, 50) + '...'
          }}"
        </p>
        <p>
          Oriģinālais autors: {{ repostedPost.author.email }}; publicēts:
          {{ new Date(repostedPost.createdAt).toLocaleDateString('lv-LV') }}
        </p>
      </div>

      <form class="mt-5" @submit.prevent="createPost">
        <div class="mb-4">
          <label
            class="block font-bold mb-2 text-gray-700 text-sm"
            for="content"
            >Ziņas saturs</label
          >
          <textarea
            id="content"
            v-model="postContent"
            class="appearance-none border focus:outline-none focus:shadow-outline leading-tight px-3 py-2 rounded shadow text-gray-700 w-full"
            placeholder="Kas jauns?..."
            required
            rows="10"
          ></textarea>
        </div>

        <input
          v-if="repostedPost"
          name="repostedPostId"
          type="hidden"
          :value="repostedPost.id"
        />

        <button
          class="bg-emerald-500 focus:outline-none focus:shadow-outline font-bold hover:bg-emerald-700 px-4 py-2 rounded text-white"
          type="submit"
        >
          Izveidot
        </button>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import type { Post } from '@/types/Data'
import { toast } from 'vue3-toastify'
import { parseErrorAndShowMessage } from '@/helpers/global'

const props = defineProps<{ postId?: number }>()

const repostedPost = ref<Post | null>(null)

const loadRepostedPost = async () => {
  if (!props.postId) return
  try {
    repostedPost.value = await (
      await fetch(`${import.meta.env.VITE_API_BASE_URL}/posts/${props.postId}`)
    ).json()
  } catch (e) {
    console.error(e)
    parseErrorAndShowMessage(e)
  }
}
loadRepostedPost()

const postContent = ref('')

const createPost = async () => {
  const flash = (await (
    await fetch(`${import.meta.env.VITE_API_BASE_URL}/posts`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        content: postContent.value,
        repostedPostId: repostedPost.value?.id,
      }),
    })
  ).json()) as { type: string; message: string }
  toast.success(flash.message)
  postContent.value = ''
}
</script>
