import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
 


import { HomeComponent } from './components/home/home.component';
import { RecipesComponent } from './components/recipes/recipes.component';
import { CartComponent } from './components/cart/cart.component';
import { CocktailsComponent } from './components/cocktails/cocktails.component';
import { canActivate } from './guards/auth.guard';


const routes: Routes = [
  { path: '', redirectTo: '/home', pathMatch: 'full'},
  { path: 'home', component: HomeComponent},
  { path: 'recipes', component: RecipesComponent, canActivate: [canActivate]},
  { path: 'cart', component: CartComponent, canActivate: [canActivate]},
  { path: 'cocktails', component: CocktailsComponent, canActivate: [canActivate]},
  { path: '**', redirectTo: '/home'},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
