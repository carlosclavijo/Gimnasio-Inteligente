import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Usuario } from 'src/app/models/usuario';
import { LoginService } from 'src/app/services/login.service';
import { RegistroService } from 'src/app/services/registro.service';

@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css']
})
export class RegistroComponent implements OnInit {
  
  objUser : Usuario;
  
  constructor(private _Usuario:RegistroService, private _router:Router) { 
    this.objUser = new Usuario();
  }

  ngOnInit(): void {
  }

  onSubmit() {
    this._Usuario.isRegistro(this.objUser).subscribe(resp => {
      console.log(this.objUser);
      localStorage.setItem("User", JSON.stringify(resp.Id));
    });
    this._router.navigate(['/index']);
  }

}
