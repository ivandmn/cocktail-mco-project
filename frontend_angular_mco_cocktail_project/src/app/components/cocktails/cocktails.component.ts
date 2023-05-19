import { Component, OnInit } from '@angular/core';
import { CocktailService } from 'src/app/services/cocktail.service';
import {CdkDragDrop, moveItemInArray, transferArrayItem} from '@angular/cdk/drag-drop';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-cocktails',
  templateUrl: './cocktails.component.html',
  styleUrls: ['./cocktails.component.css']
})
export class CocktailsComponent implements OnInit{

  cocktails: Array<any> = []

  allIngredients: Array<any> = [];

  ingredientsToElaborate: Array<any> = [];

  //Variable for disable button during API Request
  submitted: boolean = false;

  enableElaborationSuccess: boolean = false;

  error_msg: string = "";

  cocktail_elaborated: any = [];

  constructor(private CocktailService: CocktailService, private authService: AuthService, private router: Router) { }

  ngOnInit(): void {
    // this.CocktailService.getCocktailList().subscribe({
    //   next: (response: any) => {
    //     this.cocktails = response
    //   }, error: (error: any) => {
    //     switch (error.status) {
    //       default:
            
    //         break;
    //     }
    // }});

    this.CocktailService.getIngredientsList().subscribe({
      next: (response: any) => {
        this.allIngredients = response
      }, error: (error: any) => {
        switch (error.status) {
          default:
            
            break;
        }
    }});

  }

  elaborateCocktel(){
    this.submitted = true;
    this.CocktailService.elaborateCocktel(this.ingredientsToElaborate).subscribe({
      next: (response: any) => {
        this.submitted = false;
        if(response){
          this.error_msg = ''
          this.cocktail_elaborated = response;
          this.enableElaborationSuccess = true; 
          this.cocktail_elaborated.rawPrice = 0
          this.cocktail_elaborated.ingredients.forEach((element: any) => {
            this.cocktail_elaborated.rawPrice = this.cocktail_elaborated.rawPrice + element.price
          })
          this.cocktail_elaborated.rawPrice = Math.round(this.cocktail_elaborated.rawPrice * 100)/100
        } else{
          this.error_msg = 'The formula or the order of ingredients in coctail is not correct '
        };
      }, error: (error: any) => {
        this.error_msg = ''
        this.submitted = false;
        this.enableElaborationSuccess = false;
    }});
  }

  addPriceToCart(price: number ){
    this.submitted = true;
    this.CocktailService.addPriceToCart(this.authService.current_user.id, price).subscribe({
      next: (response: any) => {
        this.submitted = false;
        this.router.navigate(['home'])
      }, error: (error: any) => {
        this.submitted = false;
        switch (error.status) {
          default:
            
            break;
        }
    }});
  }


  drop(event: CdkDragDrop<string[]>) {
    if (event.previousContainer === event.container) {
      moveItemInArray(event.container.data, event.previousIndex, event.currentIndex);
    } else {
      transferArrayItem(
        event.previousContainer.data,
        event.container.data,
        event.previousIndex,
        event.currentIndex,
      );
    }
  }
}
