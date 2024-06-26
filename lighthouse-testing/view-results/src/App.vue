<template>
  <main class="container mx-auto px-4 py-8">
    <h1 class="font-bold mb-8 mt-4 text-center text-xl">
      Lighthouse testu rezultāti - {{ site }}
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
                v-for="(measurements, j) in subItem"
                :key="j"
                class="border border-gray-200 first:dark:text-white first:font-medium first:text-gray-900 first:whitespace-nowrap px-3 py-2"
                scope="row"
              >
                <div v-if="typeof measurements === 'object'" class="flex gap-2">
                  <!--                  <span class="flex flex-col leading-3 select-none text-[10px]">-->
                  <!--                    <span-->
                  <!--                      v-for="measurement in measurements"-->
                  <!--                      :key="measurement.id"-->
                  <!--                    >-->
                  <!--                      {{ formatMeasurement(measurement.numericValue) }}-->
                  <!--                    </span>-->
                  <!--                  </span>-->
                  <span>
                    {{
                      formatMeasurement(
                        measurements.reduce((a, b) => a + b.numericValue, 0) /
                          measurements.length,
                      )
                    }}
                  </span>
                </div>
                <template v-else>
                  {{ urlToText(measurements) }}
                </template>
              </td>
            </tr>
            <tr v-if="item.items.length > 1">
              <td
                class="border border-gray-200 dark:text-white font-medium px-3 py-2 text-gray-900 whitespace-nowrap"
                scope="row"
              >
                Vidējā vērtība
              </td>
              <td
                v-for="i in item.items[0].length - 1"
                :key="i"
                class="border border-gray-200 dark:text-white px-3 py-2 text-gray-900 whitespace-nowrap"
                scope="row"
              >
                {{ formatMeasurement(calculateAverage(item, i)) }}
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

const structuredAudits = getAllArchitectureData()

const formatMeasurement = (value: number) => {
  return (Math.round((value * 10000) / 1000) / 10000).toLocaleString('lv-LV', {
    maximumFractionDigits: 4,
  })
}

const site = import.meta.env.VITE_APP_DIR

const urlToTextMapping = {
  '/': 'Sākums',
  '/about-us': 'Par mums',
  '/news': 'Jaunumi',
  '/offers': 'Piedāvājumi',
  '/contacts': 'Kontakti',
  '/cart': 'Grozs',
  '/catalogue': 'Produktu katalogs',
  '/checkout': 'Maksājums',
  '/authenticate': 'Autentifikācija',
  '/todos': 'Darāmās lietas',
  '/todo-categories': 'Darbu kategorijas',
  '/spent-times': 'Pavadītais laiks',
  '/posts': 'Ziņas',
  '/posts/new': 'Jauna ziņa',
  '/user/21': 'Lietotājs',
  '/video/1': 'Video skatīšana',
}

const urlToText = (url: string) => {
  const text =
    url in urlToTextMapping
      ? urlToTextMapping[url as keyof typeof urlToTextMapping]
      : null

  return text ? `${text} (${url})` : url
}

const calculateAverage = (item: any, i: number) => {
  return (
    item.items.reduce(
      (sum, audit) =>
        sum +
        (audit[i] as Array<{ numericValue: number }>).reduce(
          (a, b) => a + b.numericValue,
          0,
        ) /
          audit[i].length,
      0,
    ) / item.items.length
  )
}
</script>
