import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Usuario } from 'src/app/models/usuario';
import { LoginService } from 'src/app/services/login.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  
  objUser : Usuario;
  
  constructor(private _Usuario:LoginService, private _router:Router) { 
    this.objUser = new Usuario();
  }

  ngOnInit(): void {
  }

  onSubmit() {
    this._Usuario.isLogin(this.objUser).subscribe(resp => {
      console.log("Respuesta"  + resp.Id);
      if (resp.Response) {
        localStorage.setItem("User", JSON.stringify(resp.Id));
        this._router.navigate(['/index']);
      } else {
        alert("No continua");
      }
    });
  }

}
