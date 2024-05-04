<template>
  <div class="container max-w-[900px] mx-auto p-4">
    <h1
      class="flex font-bold gap-4 items-center justify-between mb-4 text-2xl text-gray-800"
    >
      Pavadītais laiks
    </h1>
    <div class="overflow-x-auto relative">
      <table
        class="dark:text-gray-400 rtl:text-right text-gray-500 text-left text-sm w-full"
      >
        <thead
          class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-gray-700 text-xs uppercase"
        >
          <tr>
            <th class="px-6 py-3" scope="col">Darāmā lieta</th>
            <th class="px-6 py-3" scope="col">Pavadītais laiks</th>
            <th class="px-6 py-3" scope="col">Datums</th>
            <th class="px-6 py-3" scope="col">Darbības</th>
          </tr>
        </thead>
        <tbody v-if="data">
          <tr
            v-for="(spentTime, index) in data.spentTimes"
            :key="spentTime.id"
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
          >
            <th
              class="dark:text-white font-medium px-6 py-4 text-gray-900 whitespace-nowrap"
              scope="row"
            >
              <template
                v-if="
                  index === 0 ||
                  data.spentTimes[index - 1].todoItem.name !==
                    spentTime.todoItem.name
                "
              >
                {{ spentTime.todoItem.name }}
              </template>
            </th>
            <td class="px-6 py-4">
              {{ spentTime.formattedDuration }}
            </td>
            <td class="px-6 py-4">
              {{ new Date(spentTime.createdAt).toLocaleDateString('lv-LV') }}
            </td>
            <td class="flex gap-4 px-6 py-4">
              <a href="#"> ✏️ </a>
              <button @click="deleteSpentTime(spentTime.id)">🗑</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import type { SpentTimesPageData } from '@/types/Data'
import { toast } from 'vue3-toastify'
import { parseErrorAndShowMessage } from '@/helpers/global'

const data = ref<SpentTimesPageData>()

const fetchData = async () => {
  try {
    data.value = await (
      await fetch(`${import.meta.env.VITE_API_BASE_URL}/spent-times`, {
        headers: { 'Content-Type': 'application/json' },
      })
    ).json()
  } catch (e) {
    console.error(e)
  }
}
fetchData()

const deleteSpentTime = async (id: number) => {
  try {
    const flash = await (
      await fetch(`${import.meta.env.VITE_API_BASE_URL}/spent-times/delete`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id }),
      })
    ).json()
    toast.success(flash.message)

    if (!data.value) return
    data.value.spentTimes = data.value.spentTimes.filter(
      (spentTime) => spentTime.id !== id,
    )
  } catch (e) {
    parseErrorAndShowMessage(e)
  }
}
</script>
