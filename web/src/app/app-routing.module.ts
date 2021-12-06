import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { FormEjercicioComponent } from './pages/form-ejercicio/form-ejercicio.component';
import { IndexComponent } from './pages/index/index.component';
import { LoginComponent } from './pages/login/login.component';
import { RegistroComponent } from './pages/registro/registro.component';

const routes: Routes = [
  {
    path: '', redirectTo: "/registro", pathMatch: "full"
  },
  {
    path: 'login', component: LoginComponent
  },
  {
    path: 'registro', component: RegistroComponent
  },
  {
    path: 'index', component: IndexComponent
  },
  {
    path: 'formEjercicio', component: FormEjercicioComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }