export type Product = {
  id: number
  title: string
  description: string
  images: string[]
  category: ProductCategory
  price: string
  priceWithDiscount: number
  createdAt: string
  popularity: number
  discount: number
}

export type ProductCategory = {
  id: number
  name: string
}

export type Order = {
  id: number
  status: string
  orderItems: OrderItem[]
  totalPrice: number
}

export type OrderItem = {
  id: number
  orderId: number
  productId: number
  amount: number
  product: Product
}

export type HomePageData = {
  metadata: {
    title: string
    metaTitle: string
    metaDescription: string
    metaKeywords: string
  }
  images: { mob: string; desk: string }
  newProducts: Product[]
  popularProducts: Product[]
  productsWithDiscounts: Product[]
}

export type CataloguePageData =
  | {
      metadata: {
        title: string
        metaTitle: string
        metaDescription: string
        metaKeywords: string
      }
      itemsPerPage: number
      categories: ProductCategory[]
      selectedCategory?: string
      productsCount: number
      hasCurrentPage: boolean
      hasNextPage: boolean
      products: Product[]
      page: number
      prevPageData: { page: number; category?: string } | null
      nextPageData: { page: number; category?: string } | null
    }
  | { redirect: { page: number; category?: string } }

export type ProductPageData = {
  metadata: {
    title: string
    metaTitle: string
    metaDescription: string
    metaKeywords: string
  }
  product: Product
}

export type CartPageData = {
  metadata: {
    title: string
    metaTitle: string
    metaDescription: string
    metaKeywords: string
  }
  order: Order
}

export type CheckoutPageData = {
  metadata: {
    title: string
    metaTitle: string
    metaDescription: string
    metaKeywords: string
  }
  order: Order
}
