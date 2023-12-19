import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Observable} from "rxjs";
import {History} from "../models/history.model";
import {User} from "../models/user.model";

@Injectable({
  providedIn: 'root'
})
export class UserService {
  apiUrl = 'http://localhost:8000/api';
  constructor(private http: HttpClient) { }

  getUserData(): Observable<User> {
    const token = localStorage.getItem('id_token');
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });

    // Se nenhuma URL for fornecida, use a URL padrão da API
    return this.http.get<User>(`${this.apiUrl}/user`, { headers });

  }
}
