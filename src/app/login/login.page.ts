import { Component } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';
import { Auth } from "../models/auth.model";

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage {
  user = {
    email: '',
    password: ''
  };

  constructor(private authService: AuthService, private router: Router) {}

  login() {
    this.authService.login(this.user).subscribe({
      next: (response: Auth) => {
        this.authService.setSession(response); // Armazena o token
        this.router.navigateByUrl('/tabs'); // Certifique-se de que esta rota está definida
      },
      error: (err) => {
        console.error('Erro ao efetuar o login', err)
      }
    });
  }
}
