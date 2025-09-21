import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { AutorService } from '../services/autor';
import { Autor } from '../models/autor.model';

@Component({
  selector: 'app-autor-list',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './autor-list.html',
  styleUrl: './autor-list.css'
})
export class AutorListComponent implements OnInit {
  autores: Autor[] = [];

  constructor(private autorService: AutorService) { }

  ngOnInit(): void {
    this.carregarAutores();
  }

  carregarAutores(): void {
    this.autorService.listarAutores().subscribe(
      (data) => {
        this.autores = data;
      },
      (error) => {
        console.error('Erro ao carregar autores:', error);
      }
    );
  }

  deletarAutor(id: number): void {
    if (confirm('Tem certeza que deseja deletar este autor?')) {
      this.autorService.deletarAutor(id).subscribe(
        () => {
          this.carregarAutores();
        },
        (error) => {
          console.error('Erro ao deletar autor:', error);
        }
      );
    }
  }
}