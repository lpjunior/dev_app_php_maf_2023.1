import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {Auth} from "../models/auth.model";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrl = 'http://localhost:8000/api';
  constructor(private http: HttpClient) {}

  login(credentials: { email: string, password: string }): Observable<Auth> {
    return this.http.post<Auth>(`${this.apiUrl}/login`, credentials);
  }

  setSession(auth: Auth) {
    localStorage.setItem('id_token', auth.access_token);
  }

  isLoggedIn(): boolean {
    const token = localStorage.getItem('id_token');
    // Verifique aqui se o token é válido (não expirado)
    return token != null;
  }
}
