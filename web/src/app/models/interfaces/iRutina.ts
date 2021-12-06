import { Rutina } from "../rutina";

export interface iRutina {
    Response: boolean,
    Message: string,
    Rutina: Rutina,
    Rutinas: Rutina[],
    Length: number,
    Id: number
}