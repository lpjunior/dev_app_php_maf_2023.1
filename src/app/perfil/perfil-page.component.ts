import {Component, OnInit} from '@angular/core';
import {UserService} from "../services/user.service";
import {User} from "../models/user.model";

@Component({
  selector: 'app-perfil',
  templateUrl: 'perfil-page.component.html',
  styleUrls: ['perfil-page.component.scss']
})
export class PerfilPage implements OnInit {

  userData!:User;

  constructor(private userService: UserService) {}

  ngOnInit() {
    this.userService.getUserData().subscribe({
      next: (response: User) => {
        this.userData = response;
      },
      error: (err) => {
        console.error('Erro ao carregar os dados do usuário', err)
      }
    });
  }
}
