import measurementsData from 'virtual:json-data'
import { transformInpData } from '@/helpers/transformInpData'
import type { StructuredOutput } from '@/types/Lighthouse'

const measurements = measurementsData as Record<
  (typeof categories)[number],
  StructuredOutput
>

const categories = ['t-ssr', 'hda', 'spa', 'm-ssr', 'ssg'] as const
const sites = [
  'content-platform',
  'shopping-platform',
  'productivity-tool',
  'social-network',
] as const

const dataMapping = {
  'content-platform': transformInpData({
    tSsr: [30, 30, 30, 30, 30],
    hda: [30, 40, 30, 40, 30],
    spa: [60, 60, 40, 50, 50],
    mSsr: [40, 50, 60, 50, 50],
    ssg: [30, 40, 40, 30, 30],
  }),
  'shopping-platform': transformInpData({
    tSsr: [60, 60, 70, 70, 60],
    hda: [70, 60, 60, 60, 60],
    spa: [60, 80, 60, 50, 50],
    mSsr: [80, 100, 80, 70, 80],
  }),
  'productivity-tool': transformInpData({
    tSsr: [40, 30, 30, 40, 30],
    hda: [30, 40, 30, 30, 30],
    spa: [60, 50, 50, 60, 40],
    mSsr: [60, 70, 60, 60, 60],
  }),

  'social-network': transformInpData({
    tSsr: [40, 30, 30, 20, 30],
    hda: [80, 40, 60, 60, 50],
    spa: [30, 30, 40, 20, 20],
    mSsr: [60, 30, 70, 40, 50],
  }),
}

const metrics = [
  'first-contentful-paint',
  'largest-contentful-paint',
  'total-blocking-time',
  // 'cumulative-layout-shift',
  // 'speed-index',
  // other metrics
  'interactive',
] as const

export const getAllArchitectureData = () => {
  const { allArchitectureData, inpData } = {
    allArchitectureData: measurements,
    inpData: dataMapping[import.meta.env.VITE_APP_DIR],
  }

  return [
    ...metrics.map((auditId) => {
      const firstArchitecture =
        allArchitectureData[
          Object.keys(
            allArchitectureData,
          )[0] as keyof typeof allArchitectureData
        ]

      return {
        audit: firstArchitecture[0][0].audits[auditId],
        headers: Object.keys(allArchitectureData),
        items: new Array(firstArchitecture.length).fill(0).map((_, index) => [
          new URL(firstArchitecture[index][0].requestedUrl).pathname,
          ...Object.keys(allArchitectureData).map((key) => {
            return allArchitectureData[key as keyof typeof allArchitectureData][
              index
            ].map((x) => x.audits[auditId])
          }),
        ]),
      }
    }),
    {
      audit: {
        id: 'interaction-to-next-paint',
        title: 'Interaction to next paint',
      },
      headers: Object.keys(allArchitectureData),
      items: [['', ...Object.values(inpData)]],
    },
  ]
}
