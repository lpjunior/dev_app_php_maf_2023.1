import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Observable} from "rxjs";
import {AuthService} from "./auth.service";
import {History} from "../models/history.model";

@Injectable({
  providedIn: 'root'
})
export class HistoryService {
  private apiUrl = 'http://localhost:8000/api';

  constructor(private http: HttpClient, private authService: AuthService) {}

  getHistory(url?: string): Observable<History> {
    // Supondo que o authService tem um método para obter o token atual
    const token = localStorage.getItem('id_token');
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    });

    // Se nenhuma URL for fornecida, use a URL padrão da API
    return this.http.get<History>(url || `${this.apiUrl}/history`, { headers });
  }
}
