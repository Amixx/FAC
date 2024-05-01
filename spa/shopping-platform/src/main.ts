import './assets/app.css'
import { createApp } from 'vue'
import App from './App.vue'
import { createHead } from '@unhead/vue'
import router from './router'
import 'vue3-toastify/dist/index.css'

createApp(App).use(createHead()).use(router).mount('#app')
