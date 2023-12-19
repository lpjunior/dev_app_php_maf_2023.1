import { IonicModule } from '@ionic/angular';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { BooksPage } from './books-page.component';

import { BookPageRoutingModule } from './books-routing.module';

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    BookPageRoutingModule
  ],
  declarations: [BooksPage]
})
export class BookPageModule {}
