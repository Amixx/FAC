import contentPlatformData from '@/helpers/contentPlatformData'
import shoppingPlatformData from '@/helpers/shoppingPlatformData'
import productivityToolData from '@/helpers/productivityToolData'

const dataMapping = {
  'content-platform': contentPlatformData,
  'shopping-platform': shoppingPlatformData,
  'productivity-tool': productivityToolData,
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

export const getAllArchitectureData = (
  site: 'content-platform' | 'shopping-platform' | 'productivity-tool',
) => {
  const { allArchitectureData, inpData } = dataMapping[site]

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
