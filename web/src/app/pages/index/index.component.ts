import { Component, OnInit } from '@angular/core';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { Rutina } from 'src/app/models/rutina';
import { Ejercicio } from 'src/app/models/ejercicio';
import { GetRutinasService } from 'src/app/services/rutinas.service';
import { GetEjerciciosService } from 'src/app/services/ejercicios.service';

@Component({
    selector: 'app-index',
    templateUrl: './index.component.html',
    styleUrls: ['./index.component.css']
})

export class IndexComponent implements OnInit {
    title = 'appBootstrap';
    html: string  = "";
    closeResult: string = '';
    listaRutinas: Rutina[] = [];
    listaEjercicios: Ejercicio[] = [];
    listaEjerciciosdeRutina: Ejercicio[] = [];
    valorOpcion: number =  1;
    dato = localStorage.getItem('User');
    constructor(private modalService: NgbModal, private rutinas:GetRutinasService, private ejercicios:GetEjerciciosService) {}

    ngOnInit(): void {
        console.log(this.dato);
        this.getRutinas();
        this.getEjercicios();
    }

    cambioOpcion() {
        console.log(this.valorOpcion)
    }

    getRutinas() {
        this.rutinas.getRutinas().subscribe(resp => {
            for (let index = 0; index < resp.Rutinas.length; index++) {
                console.log(resp.Rutinas[index]);
            }
            this.listaRutinas =  resp.Rutinas;
        })
    }

    getEjercicios() {
        this.ejercicios.getEjercicios().subscribe(resp => {
            for (let index = 0; index < resp.Ejercicios.length; index++) {
                console.log(resp.Ejercicios[index]);
            }
            this.listaEjercicios =  resp.Ejercicios;
        })
    }

    perfil() {
        alert("Va a perfil");
    }
    
    cerrarSesion() {
        localStorage.clear();
        window.location.reload();
    }
    
rutinaActual: Rutina = new Rutina();

    open(content:any, item:Rutina) {
        this.rutinaActual = item;
        this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
            this.closeResult = `Closed with: ${result}`;
        }, (reason) => {
            this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
        });
    }

    private getDismissReason(reason: any): string {
        if (reason === ModalDismissReasons.ESC) {
            return 'by pressing ESC';
        } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
            return 'by clicking on a backdrop';
        } else {
            return  `with: ${reason}`;
        }
    }
}