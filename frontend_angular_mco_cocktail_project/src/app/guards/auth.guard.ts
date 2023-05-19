import { inject } from "@angular/core";
import { CanActivateFn, ActivatedRouteSnapshot, RouterStateSnapshot, Router, CanActivateChildFn } from "@angular/router";
import { map, catchError, of } from "rxjs";
import { AuthService } from '../services/auth.service';


export const canActivate: CanActivateFn = (
  route: ActivatedRouteSnapshot,
  state: RouterStateSnapshot
) => {
  const authService = inject(AuthService);
  const router = inject(Router);


  //If user is not logged, redirect to home and show error message  
  if (!authService.isLoggedIn) {
    router.navigate(['home'])
    return false;
  }
  return true;
};

export const canActivateChild: CanActivateChildFn = (route: ActivatedRouteSnapshot, state: RouterStateSnapshot) => canActivate(route, state);