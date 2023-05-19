import { Component, OnInit } from '@angular/core';
import { Inject } from '@angular/core';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { FormBuilder, FormGroup, Validators, FormControl } from '@angular/forms';
import { AuthService } from 'src/app/services/auth.service';
import { User } from 'src/app/models/user.model';



@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit{
  
  loginForm: FormGroup = new FormGroup({
    username: new FormControl('', [Validators.required,Validators.maxLength(100)]),
    password: new FormControl('', [Validators.required,Validators.maxLength(100)])
  });

  error_login_msg: string = '';
  //Variable for disable button during API Request
  submitted: boolean = false;

  constructor(private dialogRef: MatDialogRef<LoginComponent>, public AuthService: AuthService) { }

  ngOnInit(): void {

  }

  login(){
    if(this.loginForm.invalid){
      this.error_login_msg = "Username/Password incorrect"
    } else {
      this.submitted = true;
      this.AuthService.login(this.loginForm.getRawValue()).subscribe({
        next: (response: any) => {
          this.submitted = false;
          try {
              this.AuthService.current_user = response['user']
              if(!this.AuthService.setUserCookie(response['user']) || !this.AuthService.setAccessTokenCookie(response['accessToken'])){
                this.AuthService.logged_user = false
                this.AuthService.current_user = new User();
                this.error_login_msg = "Unexpected error"
              } else {
                this.AuthService.logged_user = true
                this.error_login_msg = ""
                this.dialogRef.close()
              }
          } catch (e: any){
              this.AuthService.logged_user = false
              this.AuthService.current_user = new User();
              this.error_login_msg = "Unexpected error"
          }
        }, error: (error: any) => {
          this.submitted = false;
          switch (error.status) {
            case 401: { 
              this.error_login_msg = "Username/Password incorrect"
              break;
            }
            default:
              this.error_login_msg = "Server Error"
              break;
          }
      }});
    }
  }
}
