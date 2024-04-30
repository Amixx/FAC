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
                v-for="(text, j) in subItem"
                :key="j"
                class="border border-gray-200 first:dark:text-white first:font-medium first:text-gray-900 first:whitespace-nowrap px-3 py-2"
                scope="row"
              >
                {{ text }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</template>

<script setup lang="ts">
import tSsrHome from '../../results-data/t-ssr/home.json' with { type: 'json' }
import tSsrAboutUs from '../../results-data/t-ssr/about-us.json' with { type: 'json' }
import tSsrNews from '../../results-data/t-ssr/news.json' with { type: 'json' }
import tSsrOffers from '../../results-data/t-ssr/offers.json' with { type: 'json' }
import tSsrContacts from '../../results-data/t-ssr/contacts.json' with { type: 'json' }

import hdaHome from '../../results-data/hda/home.json' with { type: 'json' }
import hdaAboutUs from '../../results-data/hda/about-us.json' with { type: 'json' }
import hdaNews from '../../results-data/hda/news.json' with { type: 'json' }
import hdaOffers from '../../results-data/hda/offers.json' with { type: 'json' }
import hdaContacts from '../../results-data/hda/contacts.json' with { type: 'json' }

import spaHome from '../../results-data/spa/home.json' with { type: 'json' }
import spaAboutUs from '../../results-data/spa/about-us.json' with { type: 'json' }
import spaNews from '../../results-data/spa/news.json' with { type: 'json' }
import spaOffers from '../../results-data/spa/offers.json' with { type: 'json' }
import spaContacts from '../../results-data/spa/contacts.json' with { type: 'json' }

import mSsrHome from '../../results-data/m-ssr/home.json' with { type: 'json' }
import mSsrAboutUs from '../../results-data/m-ssr/about-us.json' with { type: 'json' }
import mSsrNews from '../../results-data/m-ssr/news.json' with { type: 'json' }
import mSsrOffers from '../../results-data/m-ssr/offers.json' with { type: 'json' }
import mSsrContacts from '../../results-data/m-ssr/contacts.json' with { type: 'json' }

import ssgHome from '../../results-data/ssg/home.json' with { type: 'json' }
import ssgAboutUs from '../../results-data/ssg/about-us.json' with { type: 'json' }
import ssgNews from '../../results-data/ssg/news.json' with { type: 'json' }
import ssgOffers from '../../results-data/ssg/offers.json' with { type: 'json' }
import ssgContacts from '../../results-data/ssg/contacts.json' with { type: 'json' }

const allArchitectureData = {
  tSsr: [tSsrHome, tSsrAboutUs, tSsrNews, tSsrOffers, tSsrContacts],
  hda: [hdaHome, hdaAboutUs, hdaNews, hdaOffers, hdaContacts],
  spa: [spaHome, spaAboutUs, spaNews, spaOffers, spaContacts],
  mSsr: [mSsrHome, mSsrAboutUs, mSsrNews, mSsrOffers, mSsrContacts],
  ssg: [ssgHome, ssgAboutUs, ssgNews, ssgOffers, ssgContacts],
}

const inpData = {
  tSsr: '30 ms',
  hda: '40 ms',
  spa: '60 ms',
  mSsr: '30 ms',
  ssg: '30 ms',
}

const structuredAudits = [
  ...(
    [
      'first-contentful-paint',
      'largest-contentful-paint',
      'total-blocking-time',
      'cumulative-layout-shift',
      // 'speed-index',
      // other metrics
      'interactive',
    ] as const
  ).map((auditId) => ({
    audit: hdaHome.audits[auditId],
    headers: Object.keys(allArchitectureData),
    items: allArchitectureData['hda'].map((_, index) => [
      '/' + allArchitectureData['hda'][index].requestedUrl.split('/').pop(),
      ...Object.keys(allArchitectureData).map(
        (key) =>
          allArchitectureData[key as keyof typeof allArchitectureData][index]
            .audits[auditId].displayValue,
      ),
    ]),
  })),
  {
    audit: {
      id: 'interaction-to-next-paint',
      title: 'Interaction to next paint',
    },
    headers: Object.keys(allArchitectureData),
    items: [['', ...Object.values(inpData)]],
  },
]
</script>
