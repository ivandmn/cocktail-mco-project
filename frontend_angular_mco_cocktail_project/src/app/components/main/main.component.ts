import { Component } from '@angular/core';
import { OnInit } from '@angular/core';
import { CookieService } from 'ngx-cookie-service';
import { CocktailService } from 'src/app/services/cocktail.service';
import { MatDialog, MAT_DIALOG_DATA, MatDialogRef} from '@angular/material/dialog';
import { LoginComponent } from '../login/login.component';
import { AuthService } from 'src/app/services/auth.service';
import { CartComponent } from '../cart/cart.component';
import { Router } from '@angular/router';


@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.css']
})
export class MainComponent implements OnInit{

  constructor(private CocktailService: CocktailService, private dialog: MatDialog, public AuthService: AuthService, private router: Router) { }

  ngOnInit(): void {
    this.AuthService.isLoggedIn  
  }

  openLoginDialog(): void {
    const dialogRef = this.dialog.open(LoginComponent, {
      width: '450px',
      disableClose: true
    });

    dialogRef.afterClosed().subscribe(result => {
      if(result){
        this.AuthService.login(result);
      }
    });
  }

  openCartDialog(): void {
    const dialogRef2 = this.dialog.open(CartComponent, {
      width: '450px',
      disableClose: true
    });

    dialogRef2.afterClosed().subscribe(result => {
      this.router.navigate(['home'])
    });
  }

  logout(): void {
    this.AuthService.logout()
  }
}
