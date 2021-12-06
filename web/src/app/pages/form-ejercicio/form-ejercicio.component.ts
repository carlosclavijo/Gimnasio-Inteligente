import { Component, OnInit } from '@angular/core';
import { archivos } from 'src/app/models/archivos';
import { Ejercicio } from 'src/app/models/ejercicio';
import { GetEjerciciosService } from 'src/app/services/ejercicios.service';
import { UploadsService } from 'src/app/services/uploads.service';

@Component({
  selector: 'app-form-ejercicio',
  templateUrl: './form-ejercicio.component.html',
  styleUrls: ['./form-ejercicio.component.css']
})
export class FormEjercicioComponent implements OnInit {

  constructor(private upload: UploadsService, private _ejercicio: GetEjerciciosService) {
    this.objEjercicio = new Ejercicio;
  }
  
  listadoArchivos: archivos[] = [];
  dato = localStorage.getItem('User');
  objEjercicio: Ejercicio;
  
  ngOnInit(): void {
  
  }

  subirFoto(event: any) {
    for (let index = 0; index < event.target.files.length; index++) {
      let elFile = event.target.files[index];
      this.listadoArchivos.push(new archivos(elFile, elFile.name));
      this.upload.subirImagen(this.listadoArchivos, Number(this.objEjercicio.id)).subscribe(resp => {
        console.log(resp);
      });
    }
  }

  insert() {
    this.objEjercicio.idCreador = Number(this.dato);
    this._ejercicio.insertEjercicio(this.objEjercicio).subscribe(resp => {
      console.log(resp.Response);
    })
  }
}