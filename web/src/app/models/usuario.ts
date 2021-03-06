export class Usuario {

    constructor(private _id:number = 0, private _name:string = "", private _email:string = "", private _password:string = "") {

    }

    public get id():number {
        return this._id;
    }
    
    public set id(id: number){
        this._id = id;
    }

    public get name(): string {
        return this._name;
    }
    
    public set name(name: string) {
        this._name = name;
    }

    public get email(): string {
        return this._email;
    }

    public set email(email: string) {
        this._email = email;
    }

    public get password(): string {
        return this._password;
    }

    public set password(password: string) {
        this._password = password;
    }

}