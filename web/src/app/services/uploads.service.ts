import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment.prod';
import { archivos } from '../models/archivos';
import { iArchivos } from '../models/interfaces/iArchivos';
const url =  environment.url;

@Injectable({
  providedIn: 'root'
})
export class UploadsService {

  constructor(private http: HttpClient) { }
  subirImagen( subidas: archivos[], id: number) {
    const formData: FormData = new FormData();
    subidas.forEach(obj => {
      console.log(obj);
      formData.append('imagen[]', obj.file, obj.nombre + '.jpg');
    });
    const header = new HttpHeaders();
    header.append('Content-Type', 'multipart/form-data');
    return this.http.post<iArchivos>( url + 'foto/subirFotos/' + id, formData, {headers: header});
  }
}
