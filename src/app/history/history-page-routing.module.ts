import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import {HistoryPage} from "./history-page.component";

const routes: Routes = [
  {
    path: '',
    component: HistoryPage,
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class HistoryPageRoutingModule {}
