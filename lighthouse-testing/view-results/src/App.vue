<template>
  <main class="container mx-auto px-4 py-8">
    <h1 class="font-bold mb-8 mt-4 text-center text-xl">
      Lighthouse Testing Results
    </h1>

    <div class="flex flex-wrap gap-8">
      <div
        v-for="item in structuredAudits"
        :key="item.audit.id"
        class="overflow-x-auto relative"
      >
        <p class="font-bold mb-2 text-center">{{ item.audit.title }}</p>
        <table
          class="border border-gray-200 dark:text-gray-400 rtl:text-right text-gray-500 text-left text-sm"
        >
          <thead
            class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-gray-700 text-xs uppercase"
          >
            <tr>
              <th class="px-6 py-3" scope="col">URL</th>
              <th
                v-for="header in item.headers"
                :key="header"
                class="px-6 py-3"
                scope="col"
              >
                {{ header }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(subItem, i) in item.items"
              :key="i"
              class="bg-white dark:bg-gray-800 pl-4"
            >
              <td
                v-for="(audit, j) in subItem"
                :key="j"
                class="border border-gray-200 first:dark:text-white first:font-medium first:text-gray-900 first:whitespace-nowrap px-3 py-2"
                scope="row"
              >
                <template v-if="typeof audit === 'object'">
                  {{ audit.displayValue }}
                </template>
                <template v-else>
                  {{ audit }}
                </template>
              </td>
            </tr>
            <tr v-if="item.items.length > 1">
              <td
                class="border border-gray-200 dark:text-white font-medium px-3 py-2 text-gray-900 whitespace-nowrap"
                scope="row"
              >
                Average
              </td>
              <td
                v-for="i in item.items.length"
                :key="i"
                class="border border-gray-200 dark:text-white px-3 py-2 text-gray-900 whitespace-nowrap"
                scope="row"
              >
                {{
                  parseFloat(
                    (
                      item.items.reduce(
                        (sum, audit) => sum + audit[i].numericValue,
                        0,
                      ) / item.items.length
                    ).toFixed(4),
                  )
                }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</template>

<script setup lang="ts">
import { getAllArchitectureData } from '@/helpers/data'

const structuredAudits = getAllArchitectureData(import.meta.env.VITE_APP_DIR)
</script>
