import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import { AutorService } from '../services/autor';
import { Autor } from '../models/autor.model';

@Component({
  selector: 'app-autor-form',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './autor-form.html',
  styleUrl: './autor-form.css'
})
export class AutorFormComponent implements OnInit {
  autor: Autor = {
    nome: '',
    email: '',
    biografia: ''
  };
  isEditMode = false;
  autorId: number | null = null;

  constructor(
    private autorService: AutorService,
    private router: Router,
    private route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      if (params['id']) {
        this.isEditMode = true;
        this.autorId = +params['id'];
        this.carregarAutor();
      }
    });
  }

  carregarAutor(): void {
    if (this.autorId) {
      this.autorService.obterAutorPorId(this.autorId).subscribe(
        (data) => {
          this.autor = data;
        },
        (error) => {
          console.error('Erro ao carregar autor:', error);
        }
      );
    }
  }

  salvarAutor(): void {
    if (this.isEditMode && this.autorId) {
      this.autorService.atualizarAutor(this.autorId, this.autor).subscribe(
        () => {
          this.router.navigate(['/autores']);
        },
        (error) => {
          console.error('Erro ao atualizar autor:', error);
        }
      );
    } else {
      this.autorService.criarAutor(this.autor).subscribe(
        () => {
          this.router.navigate(['/autores']);
        },
        (error) => {
          console.error('Erro ao criar autor:', error);
        }
      );
    }
  }

  cancelar(): void {
    this.router.navigate(['/autores']);
  }
}