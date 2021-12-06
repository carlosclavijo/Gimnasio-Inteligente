import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment.prod';
import { Ejercicio } from '../models/ejercicio';
import { iEjercicio } from '../models/interfaces/iEjercicio';
import { Respuesta } from '../models/interfaces/respuesta';

@Injectable({
  providedIn: 'root'
})
export class GetEjerciciosService {
  urlApi = environment.url;
  constructor(private http: HttpClient) { }

  getEjercicios() {
    const headers = new HttpHeaders({
      'Content-type': 'application/json'
    });
    return this.http.get<iEjercicio>(this.urlApi + "ejercicio")
  }

  getEjercicioById(id: number) {
    const headers = new HttpHeaders({
      'Content-type': 'application/json'
    });
    return this.http.get<iEjercicio>(this.urlApi + "ejercicio/" + id)
  }

  insertEjercicio(objEjercicio: Ejercicio) {
    const headers = new HttpHeaders({
      'Content-type': 'application/json'
    });
    let obj = {
      "nombre": objEjercicio.nombre + "",
      "musculos": objEjercicio.musculos + "",
      "descripcion": objEjercicio.descripcion + "",
      "idCreador": objEjercicio.idCreador + ""
    }
    const params = JSON.stringify(obj);
    return this.http.post<Respuesta>(this.urlApi + "ejercicio", params, { headers });
  }

}
