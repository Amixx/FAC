import './assets/app.css'
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createHead } from '@unhead/vue'

//@ts-ignore
createApp(App).use(createHead()).use(router).mount('#app')
