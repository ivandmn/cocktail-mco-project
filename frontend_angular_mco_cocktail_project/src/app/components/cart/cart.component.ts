import { Component, OnInit } from '@angular/core';
import { MatDialogRef } from '@angular/material/dialog';
import { AuthService } from 'src/app/services/auth.service';
import { CocktailService } from '../../services/cocktail.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit{

    //Variable for disable button during API Request
    submitted: boolean = false;

    totalCart: any = 0

    constructor(private dialogRef: MatDialogRef<CartComponent>, public AuthService: AuthService, private CocktailService: CocktailService, private router: Router) { }
  
    ngOnInit(): void {
  
      this.getCartPrice()
      
    }

    getCartPrice(){
      this.submitted = true;
      this.CocktailService.getPriceCart().subscribe({
        next: (response: any) => {
          this.totalCart = response;
          this.submitted = false;
        }, error: (error: any) => {
          this.submitted = false;
      }})
    }

    completePurchases(){
      this.submitted = true;
      this.CocktailService.completePurchases().subscribe({
        next: (response: any) => {
          this.totalCart = 0
          this.submitted = false;
        }, error: (error: any) => {
          this.submitted = false;
      }})
    }
}
