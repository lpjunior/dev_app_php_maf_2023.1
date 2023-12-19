import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class BookService {

  apiUrl = 'http://localhost:8000/api';
  constructor(private http: HttpClient) { }

  getBooks(url: string = ''): Observable<any> {
    const endpoint = url ? url : `${this.apiUrl}/books`;
    return this.http.get(endpoint);
  }
}
