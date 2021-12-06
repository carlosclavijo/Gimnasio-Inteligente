import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment.prod';
import { Respuesta } from '../models/interfaces/respuesta';
import { Usuario } from '../models/usuario';

@Injectable({
  providedIn: 'root'
})
export class RegistroService {
  urlApi  = environment.url;
  constructor(private http: HttpClient) { }

  isRegistro(objUser: Usuario) {
    const headers = new HttpHeaders({
      'Content-type': 'application/json'
    });
    let obj = {
      "name": objUser.name + "",
      "email": objUser.email + "",
      "password": objUser.password + ""
    }
    const params = JSON.stringify(obj);
    return this.http.post<Respuesta>(this.urlApi + "user/registro", params, { headers });
  }
}
