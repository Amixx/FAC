import { toast } from 'vue3-toastify'

export const parseErrorAndShowMessage = (e: unknown) => {
  console.error(e)
  toast.error(
    typeof e === 'object' &&
      e &&
      'message' in e &&
      typeof e.message === 'string'
      ? e.message
      : 'Notika neparedzēta kļūda!',
  )
}
