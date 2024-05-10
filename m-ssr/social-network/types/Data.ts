export type Post = {
  id: number
  content: string
  author: User
  repostedPost: Post | null
  createdAt: string
  postLikes: PostLike[]
}

export type PostLike = {
  id: number
  author: User
  post: Post
  createdAt: string
}

export type User = {
  id: number
  email: string
  fullName: string
  biography: string
  phoneNumber: string
  physicalAddress: string
  workplace: string
  website: string
  createdAt: string
  avatar: string
}

export type PostsPageData = {
  posts: Post[]
  lastPage: number
  hasMoreItems: boolean
}

export type PostNewPageData = {
  post?: Post
}

export type UserPageData = {
  user: User
}

export type UserPostsData = {
  posts: Post[]
}

export type PostData = {
  post: Post
}
