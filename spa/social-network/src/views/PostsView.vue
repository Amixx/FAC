<template>
  <div class="container mx-auto p-4">
    <h1 class="flex gap-4 items-center justify-between mb-4">
      <span class="font-bold text-2xl text-gray-800">Ziņas</span>
      <router-link
        class="font-medium hover:text-gray-700 hover:underline text-emerald-500"
        :to="{ name: 'NEW_POST' }"
      >
        Jauna ziņa
      </router-link>
    </h1>
    <ul
      v-if="data"
      class="gap-4 grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4"
    >
      <PostCard v-for="post in data.posts" :key="post.id" :post="post" />
      <li v-if="data.posts.length === 0">
        <div class="bg-white p-4 rounded-lg shadow-lg">
          <p>Netika atrasta neviena ziņa.</p>
        </div>
      </li>
      <li v-if="data.posts.length && data.hasMoreItems">
        <button
          class="bg-white flex flex-col justify-between leading-normal mt-4 p-4 rounded-lg shadow-lg w-full"
          @click="loadMoreItems()"
        >
          <span class="font-bold text-sm">Ielādēt vēl</span>
        </button>
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import PostCard from '@/components/PostCard.vue'
import type { PostsPageData } from '@/types/Data'
import { parseErrorAndShowMessage } from '@/helpers/global'

const data = ref<PostsPageData>()

let lastPage = 1

const fetchData = async () => {
  try {
    const url = new URL(
      `${import.meta.env.VITE_API_BASE_URL}/posts`,
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
