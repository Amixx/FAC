import { toast } from 'vue3-toastify'
import type { Post, User } from '@/types/Data'

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

export const isPostLikedByUser = (post: Post, user: User | null) => {
  if (!user) return false
  return post.postLikes.some((postLike) => postLike.author.id === user.id)
}

export const isPostAuthoredByUser = (post: Post, user: User | null) => {
  if (!user) return false
  return post.author.id === user.id
}
