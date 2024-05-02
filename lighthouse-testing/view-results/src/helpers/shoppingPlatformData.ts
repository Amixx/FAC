import tSsrHome from '../../../results-data/shopping-platform/t-ssr/home.json' with { type: 'json' }
import tSsrCart from '../../../results-data/shopping-platform/t-ssr/cart.json' with { type: 'json' }
import tSsrCatalogue from '../../../results-data/shopping-platform/t-ssr/catalogue.json' with { type: 'json' }
import tSsrCheckout from '../../../results-data/shopping-platform/t-ssr/checkout.json' with { type: 'json' }

import hdaHome from '../../../results-data/shopping-platform/hda/home.json' with { type: 'json' }
import hdaCart from '../../../results-data/shopping-platform/hda/cart.json' with { type: 'json' }
import hdaCatalogue from '../../../results-data/shopping-platform/hda/catalogue.json' with { type: 'json' }
import hdaCheckout from '../../../results-data/shopping-platform/hda/checkout.json' with { type: 'json' }

import spaHome from '../../../results-data/shopping-platform/spa/home.json' with { type: 'json' }
import spaCart from '../../../results-data/shopping-platform/spa/cart.json' with { type: 'json' }
import spaCatalogue from '../../../results-data/shopping-platform/spa/catalogue.json' with { type: 'json' }
import spaCheckout from '../../../results-data/shopping-platform/spa/checkout.json' with { type: 'json' }

import mSsrHome from '../../../results-data/shopping-platform/m-ssr/home.json' with { type: 'json' }
import mSsrCart from '../../../results-data/shopping-platform/m-ssr/cart.json' with { type: 'json' }
import mSsrCatalogue from '../../../results-data/shopping-platform/m-ssr/catalogue.json' with { type: 'json' }
import mSsrCheckout from '../../../results-data/shopping-platform/m-ssr/checkout.json' with { type: 'json' }

import { transformInpData } from '@/helpers/transformInpData'

export default {
  allArchitectureData: {
    tSsr: [tSsrHome, tSsrCart, tSsrCatalogue, tSsrCheckout],
    hda: [hdaHome, hdaCart, hdaCatalogue, hdaCheckout],
    spa: [spaHome, spaCart, spaCatalogue, spaCheckout],
    mSsr: [mSsrHome, mSsrCart, mSsrCatalogue, mSsrCheckout],
  },
  inpData: transformInpData({
    tSsr: 60,
    hda: 60,
    spa: 60,
    mSsr: 80,
  }),
}
