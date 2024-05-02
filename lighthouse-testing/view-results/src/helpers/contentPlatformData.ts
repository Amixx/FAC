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

import { transformInpData } from '@/helpers/transformInpData'

export default {
  allArchitectureData: {
    tSsr: [tSsrHome, tSsrAboutUs, tSsrNews, tSsrOffers, tSsrContacts],
    hda: [hdaHome, hdaAboutUs, hdaNews, hdaOffers, hdaContacts],
    spa: [spaHome, spaAboutUs, spaNews, spaOffers, spaContacts],
    mSsr: [mSsrHome, mSsrAboutUs, mSsrNews, mSsrOffers, mSsrContacts],
    ssg: [ssgHome, ssgAboutUs, ssgNews, ssgOffers, ssgContacts],
  },
  inpData: transformInpData({
    tSsr: 30,
    hda: 40,
    spa: 60,
    mSsr: 30,
    ssg: 30,
  }),
}
