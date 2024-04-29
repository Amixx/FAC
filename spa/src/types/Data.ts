type SocialLink = {
  name: string
  url: string
}

type Page = {
  title: string
  metaTitle: string
  metaDescription: string
  metaKeywords: string
  content: string[] | string
  images: Image[]
}

type Image = {
  desk: string
  mob: string
}

type NewsItem = {
  title: string
  date: string
  image: Image
  description: string
}

type Offer = {
  title: string
  description: string
  starting_price: string
  image: Image
}

type ContactInfo = {
  email: string
  phone: string
  address: string
}

type NewsPage = Page & {
  news_items: NewsItem[]
}

type OffersPage = Page & {
  offers: Offer[]
}

type ContactsPage = Page & {
  contact_info: ContactInfo
}

type FooterData = {
  social: SocialLink[]
}

type Data = {
  branding: {
    name: string
    slogan: string
  }
  footer: FooterData
  pages: Page[]
}
