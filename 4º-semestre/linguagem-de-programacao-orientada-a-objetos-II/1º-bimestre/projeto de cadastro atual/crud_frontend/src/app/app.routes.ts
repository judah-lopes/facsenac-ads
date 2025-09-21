import { Routes } from '@angular/router';
import { AutorListComponent } from './autor-list/autor-list';
import { AutorFormComponent } from './autor-form/autor-form';

export const routes: Routes = [
  { path: '', redirectTo: '/autores', pathMatch: 'full' },
  { path: 'autores', component: AutorListComponent },
  { path: 'autor/novo', component: AutorFormComponent },
  { path: 'autor/editar/:id', component: AutorFormComponent }
];
