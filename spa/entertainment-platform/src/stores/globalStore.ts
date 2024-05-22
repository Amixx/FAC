import { ref } from 'vue'
import type { User } from '@/types/Data'

const currentUser = ref<User | null>(null)

export { currentUser }
