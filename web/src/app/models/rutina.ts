import { Ejercicio } from "./ejercicio";

export class Rutina {

    constructor(
        private _id: number = 0,
        private _nombre: string = "",
        private _visibilidad: number = 0,
        private _descripcion: string = "",
        private _puntuacion: number = 0,
        private _nombreCreador: string = "",
        private _ejercicios: Ejercicio[] = []) {

    }

    public get id():number {
        return this._id;
    }
    
    public set id(id: number){
        this._id = id;
    }

    public get nombre(): string {
        return this._nombre;
    }
    
    public set nombre(nombre: string) {
        this._nombre = nombre;
    }

    public get visibilidad(): number {
        return this._visibilidad;
    }

    public set visibilidad(visibilidad: number) {
        this._visibilidad = visibilidad;
    }

    public get descripcion(): string {
        return this._descripcion;
    }
    
    public set descripcion(descripcion: string) {
        this._descripcion = descripcion;
    }

    public get puntuacion(): number {
        return this._puntuacion;
    }

    public set puntuacion(puntuacion: number) {
        this._puntuacion = puntuacion;
    }

    public get nombreCreador(): string {
        return this._nombreCreador;
    }
    
    public set nombreCreador(nombreCreador: string) {
        this._nombreCreador = nombreCreador;
    }

    public get ejercicios(): Ejercicio[] {
        return this._ejercicios;
    }
    
    public set ejercicios(ejercicios: Ejercicio[]) {
        this._ejercicios = ejercicios;
    }

}