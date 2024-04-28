import './assets/app.css'
import { createApp } from 'vue'
import App from './App.vue'
import { createHead } from '@unhead/vue'
import router from './router'

createApp(App).use(createHead()).use(router).mount('#app')
