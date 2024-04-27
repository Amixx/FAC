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
  images: string[]
}

type NewsItem = {
  title: string
  date: string
  image: string
  description: string
}

type Offer = {
  title: string
  description: string
  starting_price: string
  image: string
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
