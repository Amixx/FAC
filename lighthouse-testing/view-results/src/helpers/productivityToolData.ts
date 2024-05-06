import tSsrAuthenticate from '../../../results-data/productivity-tool/t-ssr/authenticate.json' with { type: 'json' }
import tSsrTodos from '../../../results-data/productivity-tool/t-ssr/todos.json' with { type: 'json' }
import tSsrTodoCategories from '../../../results-data/productivity-tool/t-ssr/todo-categories.json' with { type: 'json' }
import tSsrSpentTimes from '../../../results-data/productivity-tool/t-ssr/spent-times.json' with { type: 'json' }

import hdaAuthenticate from '../../../results-data/productivity-tool/hda/authenticate.json' with { type: 'json' }
import hdaTodos from '../../../results-data/productivity-tool/hda/todos.json' with { type: 'json' }
import hdaTodoCategories from '../../../results-data/productivity-tool/hda/todo-categories.json' with { type: 'json' }
import hdaSpentTimes from '../../../results-data/productivity-tool/hda/spent-times.json' with { type: 'json' }

import spaAuthenticate from '../../../results-data/productivity-tool/spa/authenticate.json' with { type: 'json' }
import spaTodos from '../../../results-data/productivity-tool/spa/todos.json' with { type: 'json' }
import spaTodoCategories from '../../../results-data/productivity-tool/spa/todo-categories.json' with { type: 'json' }
import spaSpentTimes from '../../../results-data/productivity-tool/spa/spent-times.json' with { type: 'json' }

import mSsrAuthenticate from '../../../results-data/productivity-tool/m-ssr/authenticate.json' with { type: 'json' }
import mSsrTodos from '../../../results-data/productivity-tool/m-ssr/todos.json' with { type: 'json' }
import mSsrTodoCategories from '../../../results-data/productivity-tool/m-ssr/todo-categories.json' with { type: 'json' }
import mSsrSpentTimes from '../../../results-data/productivity-tool/m-ssr/spent-times.json' with { type: 'json' }

import { transformInpData } from '@/helpers/transformInpData'

export default {
  allArchitectureData: {
    tSsr: [tSsrAuthenticate, tSsrTodos, tSsrTodoCategories, tSsrSpentTimes],
    hda: [hdaAuthenticate, hdaTodos, hdaTodoCategories, hdaSpentTimes],
    spa: [spaAuthenticate, spaTodos, spaTodoCategories, spaSpentTimes],
    mSsr: [mSsrAuthenticate, mSsrTodos, mSsrTodoCategories, mSsrSpentTimes],
  },
  inpData: transformInpData({
    tSsr: 60,
    hda: 30,
    spa: 40,
    mSsr: 30,
  }),
}
