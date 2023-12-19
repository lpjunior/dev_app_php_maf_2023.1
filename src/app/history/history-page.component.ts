import {Component, OnInit} from "@angular/core";
import {HistoryService} from "../services/history.service";
import {BookPaginate} from "../models/book.paginate";
import {History} from "../models/history.model";

@Component({
  selector: 'app-history',
  templateUrl: 'history-page.component.html',
  styleUrls: ['history-page.component.scss']
})
export class HistoryPage implements OnInit {
  historyData!: History;

  constructor(private historicoService: HistoryService) {}

  ngOnInit() {
    this.loadHistory();
  }

  loadHistory(url: string = '') {
    this.historicoService.getHistory(url).subscribe({
      next: (response: History) => {
        this.historyData = response;
      },
      error: (err) => {
        console.error('Erro ao carregar o histórico', err)
      }
    });
  }

  // Função adicional para carregar a próxima ou a página anterior
  changePage(url: string) {
    this.loadHistory(url);
  }
}
