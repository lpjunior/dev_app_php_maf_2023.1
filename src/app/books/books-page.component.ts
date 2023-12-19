import {Component, OnInit} from '@angular/core';
import {BookService} from "../services/book.service";
import {BookPaginate} from "../models/book.paginate";

@Component({
  selector: 'app-books',
  templateUrl: 'books-page.component.html',
  styleUrls: ['books-page.component.scss']
})
export class BooksPage implements OnInit {

  dataBook!: BookPaginate;
  constructor(private bookService: BookService) {}

  ngOnInit() {
    this.loadBook();
  }

  private loadBook(url:string = '') {
    this.bookService.getBooks(url).subscribe({
      next: (response: BookPaginate) => {
        this.dataBook = response;
      },
      error: (err) => {
        console.error('Erro ao carregar os livros', err)
      }
    });
  }

  loadPage(url: string) {
    this.loadBook(url);
  }
}
