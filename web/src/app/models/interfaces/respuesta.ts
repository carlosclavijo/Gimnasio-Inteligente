import { Usuario } from "../usuario";

export interface Respuesta {
    Response: boolean,
    Message: string,
    User: Usuario,
    Length: number,
    Id: number
}