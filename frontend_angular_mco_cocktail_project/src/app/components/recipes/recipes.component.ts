import { Component, OnInit } from '@angular/core';
import { CocktailService } from 'src/app/services/cocktail.service';

@Component({
  selector: 'app-recipes',
  templateUrl: './recipes.component.html',
  styleUrls: ['./recipes.component.css']
})
export class RecipesComponent implements OnInit{

  cocktails: Array<any> = []

  constructor(private CocktailService: CocktailService) { }

  ngOnInit(): void {
    this.CocktailService.getCocktailList().subscribe({
      next: (response: any) => {
        this.cocktails = response
      }, error: (error: any) => {
        switch (error.status) {
          default:
            
            break;
        }
    }});

  }
}
