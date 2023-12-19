import {Book} from "./book.model";

export interface History {
  current_page: number
  data: Data[]
  first_page_url: string
  from: number
  last_page: number
  last_page_url: string
  links: Link[]
  next_page_url: any
  path: string
  per_page: number
  prev_page_url: any
  to: number
  total: number
}

export interface Data {
  id: number
  user_id: number
  book_id: number
  loan_date?: string
  return_date?: string
  returned?: number
  created_at: string
  updated_at: string
  book: Book
  reservation_date?: string
  expiration_date: any
  status?: string
}

export interface Link {
  url?: string
  label: string
  active: boolean
}
