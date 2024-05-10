import measurementsData from 'virtual:json-data'
import { transformInpData } from '@/helpers/transformInpData'
import type { StructuredOutput } from '@/types/Lighthouse'

const measurements = measurementsData as Record<
  (typeof sites)[number],
  Record<(typeof categories)[number], StructuredOutput>
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
    tSsr: 30,
    hda: 40,
    spa: 60,
    mSsr: 30,
    ssg: 30,
  }),
  'shopping-platform': transformInpData({
    tSsr: 60,
    hda: 60,
    spa: 60,
    mSsr: 80,
  }),
  'productivity-tool': transformInpData({
    tSsr: 60,
    hda: 30,
    spa: 40,
    mSsr: 30,
  }),

  // TODO: measure
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
    allArchitectureData: measurements[import.meta.env.VITE_APP_DIR],
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

      console.log(
        allArchitectureData,
        firstArchitecture,
        Object.keys(allArchitectureData),
      )

      return {
        audit: firstArchitecture[0][0].audits[auditId],
        headers: Object.keys(allArchitectureData),
        items: firstArchitecture[0].map((_, index) => [
          '/' + firstArchitecture[index][0].requestedUrl.split('/').pop(),
          ...Object.keys(allArchitectureData).map((key) => {
            const items = allArchitectureData[
              key as keyof typeof allArchitectureData
            ][index].map((x) => x.audits[auditId])
            return items
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
