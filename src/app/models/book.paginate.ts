import {Book} from "./book.model";

export interface BookPaginate {
  currentPage: any
  data: Book[]
  perPage: any
  total: any
  lastPage: any
  previousPage: any
  nextPage: any
}
