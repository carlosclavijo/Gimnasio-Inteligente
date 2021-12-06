import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment.prod';
import { iRutina } from '../models/interfaces/iRutina';

@Injectable({
  providedIn: 'root'
})
export class GetRutinasService {
  urlApi = environment.url;
  constructor(private http: HttpClient) { }

  getRutinas() {
    const headers = new HttpHeaders({
      'Content-type': 'application/json'
    });
    return this.http.get<iRutina>(this.urlApi + "rutina");
  }
}
