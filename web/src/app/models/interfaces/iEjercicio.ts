import { Ejercicio } from "../ejercicio";

export interface iEjercicio {
    Response: boolean,
    Message: string,
    Ejercicio: Ejercicio,
    Ejercicios: Ejercicio[],
    Length: number,
    Id: number
}