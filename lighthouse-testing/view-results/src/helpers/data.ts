import tSsrHome from '../../../results-data/content-platform/t-ssr/home.json' with { type: 'json' }
import tSsrAboutUs from '../../../results-data/content-platform/t-ssr/about-us.json' with { type: 'json' }
import tSsrNews from '../../../results-data/content-platform/t-ssr/news.json' with { type: 'json' }
import tSsrOffers from '../../../results-data/content-platform/t-ssr/offers.json' with { type: 'json' }
import tSsrContacts from '../../../results-data/content-platform/t-ssr/contacts.json' with { type: 'json' }

import hdaHome from '../../../results-data/content-platform/hda/home.json' with { type: 'json' }
import hdaAboutUs from '../../../results-data/content-platform/hda/about-us.json' with { type: 'json' }
import hdaNews from '../../../results-data/content-platform/hda/news.json' with { type: 'json' }
import hdaOffers from '../../../results-data/content-platform/hda/offers.json' with { type: 'json' }
import hdaContacts from '../../../results-data/content-platform/hda/contacts.json' with { type: 'json' }

import spaHome from '../../../results-data/content-platform/spa/home.json' with { type: 'json' }
import spaAboutUs from '../../../results-data/content-platform/spa/about-us.json' with { type: 'json' }
import spaNews from '../../../results-data/content-platform/spa/news.json' with { type: 'json' }
import spaOffers from '../../../results-data/content-platform/spa/offers.json' with { type: 'json' }
import spaContacts from '../../../results-data/content-platform/spa/contacts.json' with { type: 'json' }

import mSsrHome from '../../../results-data/content-platform/m-ssr/home.json' with { type: 'json' }
import mSsrAboutUs from '../../../results-data/content-platform/m-ssr/about-us.json' with { type: 'json' }
import mSsrNews from '../../../results-data/content-platform/m-ssr/news.json' with { type: 'json' }
import mSsrOffers from '../../../results-data/content-platform/m-ssr/offers.json' with { type: 'json' }
import mSsrContacts from '../../../results-data/content-platform/m-ssr/contacts.json' with { type: 'json' }

import ssgHome from '../../../results-data/content-platform/ssg/home.json' with { type: 'json' }
import ssgAboutUs from '../../../results-data/content-platform/ssg/about-us.json' with { type: 'json' }
import ssgNews from '../../../results-data/content-platform/ssg/news.json' with { type: 'json' }
import ssgOffers from '../../../results-data/content-platform/ssg/offers.json' with { type: 'json' }
import ssgContacts from '../../../results-data/content-platform/ssg/contacts.json' with { type: 'json' }

export const getAllArchitectureData = (
  site: 'content-platform' | 'shopping-platform',
) => {
  const { allArchitectureData, inpData } = {
    'content-platform': {
      allArchitectureData: {
        tSsr: [tSsrHome, tSsrAboutUs, tSsrNews, tSsrOffers, tSsrContacts],
        hda: [hdaHome, hdaAboutUs, hdaNews, hdaOffers, hdaContacts],
        spa: [spaHome, spaAboutUs, spaNews, spaOffers, spaContacts],
        mSsr: [mSsrHome, mSsrAboutUs, mSsrNews, mSsrOffers, mSsrContacts],
        ssg: [ssgHome, ssgAboutUs, ssgNews, ssgOffers, ssgContacts],
      },
      inpData: {
        tSsr: { numericValue: 30, displayValue: '30 ms' },
        hda: { numericValue: 40, displayValue: '40 ms' },
        spa: { numericValue: 60, displayValue: '60 ms' },
        mSsr: { numericValue: 30, displayValue: '30 ms' },
        ssg: { numericValue: 30, displayValue: '30 ms' },
      },
    },
    'shopping-platform': {
      allArchitectureData: {
        tSsr: [tSsrHome, tSsrAboutUs, tSsrNews, tSsrOffers, tSsrContacts],
        hda: [hdaHome, hdaAboutUs, hdaNews, hdaOffers, hdaContacts],
        spa: [spaHome, spaAboutUs, spaNews, spaOffers, spaContacts],
        mSsr: [mSsrHome, mSsrAboutUs, mSsrNews, mSsrOffers, mSsrContacts],
        ssg: [ssgHome, ssgAboutUs, ssgNews, ssgOffers, ssgContacts],
      },
      inpData: {
        tSsr: { numericValue: 30, displayValue: '30 ms' },
        hda: { numericValue: 40, displayValue: '40 ms' },
        spa: { numericValue: 60, displayValue: '60 ms' },
        mSsr: { numericValue: 30, displayValue: '30 ms' },
        ssg: { numericValue: 30, displayValue: '30 ms' },
      },
    },
  }[site]

  return [
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
    ).map((auditId) => {
      const firstArchitecture =
        allArchitectureData[
          Object.keys(
            allArchitectureData,
          )[0] as keyof typeof allArchitectureData
        ]

      return {
        audit: firstArchitecture[0].audits[auditId],
        headers: Object.keys(allArchitectureData),
        items: firstArchitecture.map((_, index) => [
          '/' + firstArchitecture[index].requestedUrl.split('/').pop(),
          ...Object.keys(allArchitectureData).map(
            (key) =>
              allArchitectureData[key as keyof typeof allArchitectureData][
                index
              ].audits[auditId],
          ),
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
