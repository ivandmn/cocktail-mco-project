import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpResponse} from '@angular/common/http';
import { CookieService } from 'ngx-cookie-service';
import { Observable } from 'rxjs';
import { AuthService } from './auth.service';


@Injectable({
  providedIn: 'root'
})
export class CocktailService {

   //Backend base domain
   ROOT_URL: string = 'http://localhost:8000/api';
   //Request options
   request_options: Object = {headers: new HttpHeaders({'Content-Type':'application/json'}), withCredentials: true, responseType: "json" as const};

  constructor(private http: HttpClient, private CookieService: CookieService, private AuthService: AuthService) { }

 /**
   * **Sends an HTTP request to the backend to get all cocktails**
   * @return {Observable<HttpResponse<any>>} Observable HTTP Response
   */
  getCocktailList(): Observable<HttpResponse<any>>{
    return this.http.get<any>(`${this.ROOT_URL}/cocktail`, this.request_options)
  }

  /**
   * **Sends an HTTP request to the backend to get all ingredients**
   * @return {Observable<HttpResponse<any>>} Observable HTTP Response
   */
  getIngredientsList(): Observable<HttpResponse<any>>{
    return this.http.get<any>(`${this.ROOT_URL}/ingredient`, this.request_options)
  }

  /**
   * **Sends an HTTP request to the backend to elaborate a cocktel if exists**
   * @param {any} object Object with all ingredients
   * @return {Observable<HttpResponse<any>>} Observable HTTP Response
   */
  elaborateCocktel(object: any): Observable<HttpResponse<any>>{
    return this.http.post<any>(`${this.ROOT_URL}/cocktail/elaborateCocktail`, object, this.request_options)
  }

  addPriceToCart(current_user_id: number | null, price_added: number){
    return this.http.post<any>(`${this.ROOT_URL}/order`, {user_id: current_user_id, price: price_added}, this.request_options)
  }

  getPriceCart(){
    return this.http.post<any>(`${this.ROOT_URL}/getCartPrice`, {user_id: this.AuthService.current_user.id}, this.request_options)
  }

  completePurchases(){
    return this.http.post<any>(`${this.ROOT_URL}/completePurchases`, {user_id: this.AuthService.current_user.id}, this.request_options)
  }


}
