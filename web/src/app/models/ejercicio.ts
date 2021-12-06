export class Ejercicio {

    constructor(
        private _id: number = 0,
        private _nombre: string = "",
        private _musculos: string = "",
        private _descripcion: string = "",
        private _video: string = "",
        private _idCreador: number = 0,
        private _nombreCreador: string = "") {
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

    public get musculos(): string {
        return this._musculos;
    }

    public set musculos(musculos: string) {
        this._musculos = musculos;
    }

    public get descripcion(): string {
        return this._descripcion;
    }
    
    public set descripcion(descripcion: string) {
        this._descripcion = descripcion;
    }

    public get video(): string {
        return this._video;
    }

    public set video(video: string) {
        this._video  = video;
    }

    public get idCreador():number {
        return this._idCreador;
    }
    
    public set idCreador(idCreador: number){
        this._idCreador = idCreador;
    }

    public get nombreCreador(): string {
        return this._nombreCreador;
    }
    
    public set nombreCreador(nombreCreador: string) {
        this._nombreCreador = nombreCreador;
    }

}