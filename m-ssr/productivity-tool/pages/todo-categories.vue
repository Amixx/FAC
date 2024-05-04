<template>
  <div class="container max-w-[700px] mx-auto p-4">
    <h1 class="flex gap-4 items-center justify-between mb-4">
      <span class="font-bold text-2xl text-gray-800">Darbu kategorijas</span>
      <a href="#">➕</a>
    </h1>
    <div class="overflow-x-auto relative">
      <table
        class="dark:text-gray-400 rtl:text-right text-gray-500 text-left text-sm w-full"
      >
        <thead
          class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-gray-700 text-xs uppercase"
        >
          <tr>
            <th class="px-6 py-3" scope="col">Nosaukums</th>
            <th class="px-6 py-3" scope="col">Krāsa</th>
            <th class="px-6 py-3" scope="col">Darbības</th>
          </tr>
        </thead>
        <tbody v-if="data">
          <tr
            v-for="category in data.todoCategories"
            :key="category.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <th
              class="dark:text-white font-medium px-6 py-4 text-gray-900 whitespace-nowrap"
              scope="row"
            >
              {{ category.name }}
            </th>
            <td class="px-6 py-4">
              <span
                class="h-6 inline-block rounded-full w-6"
                :style="{ background: category.color }"
              ></span>
            </td>
            <td class="flex gap-4 px-6 py-4">
              <a href="#">✏️</a>
              <button @click="deleteCategory(category.id)">🗑️</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { TodoCategoriesPageData } from '@/types/Data'
import { toast } from 'vue3-toastify'
import { parseErrorAndShowMessage } from '@/helpers/global'

const { data } = useFetch<TodoCategoriesPageData>('/todo-categories', {
  baseURL: import.meta.env.VITE_API_BASE_URL,
})

const deleteCategory = async (id: number) => {
  try {
    const flash = await $fetch<{ type: string; message: string }>(
      `${import.meta.env.VITE_API_BASE_URL}/todo-categories/delete`,
      {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id }),
      },
    )
    toast.success(flash.message)

    if (!data.value) return
    data.value.todoCategories = data.value.todoCategories.filter(
      (category) => category.id !== id,
    )
  } catch (e) {
    console.error(e)
    parseErrorAndShowMessage(e)
  }
}
</script>
