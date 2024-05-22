export type Video = {
  id: number
  title: string
  description: string
  youtubeId: string
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

export type HomePageData = {
  videos: Video[]
  lastPage: number
  hasMoreItems: boolean
}

export type VideoPageData = {
  video: Video
  relatedVideos: Video[]
}
