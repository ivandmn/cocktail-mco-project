import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpResponse} from '@angular/common/http';
import { CookieService } from 'ngx-cookie-service';
import { Observable } from 'rxjs';
import { User } from '../models/user.model';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  //Backend base domain
  ROOT_URL: string = 'http://localhost:8000/api';
  //Request options
  request_options: Object = {headers: new HttpHeaders({'Content-Type':'application/json', 'Access-Control-Allow-Origin': '*'}), withCredentials: true, responseType: "json" as const};
  //Variable that indicates if the user is logged in
  logged_user: boolean = false;
  //Variable for save current user info
  current_user: User = new User;

  constructor(private http: HttpClient, private CookieService: CookieService, private router: Router) { }

  /**
   * **Sends an HTTP request to the backend log in**
   * @param {Object} user {'username': str, 'password': str}
   * @return {Observable<HttpResponse<any>>} Observable HTTP Response
   */
  login(user: Object): Observable<HttpResponse<any>>{
    return this.http.post<any>(`${this.ROOT_URL}/login`, user, this.request_options);
  }

  /**
   * **Sends an HTTP request to the backend to log out**
   */
  logout(): void{
    this.http.post<any>(`${this.ROOT_URL}/logout`, this.request_options).subscribe({
      next: () => {
        this.logged_user = false;
        this.current_user = new User();
        this.CookieService.delete('access_token')
        this.CookieService.delete('user')
        this.router.navigate(['home'])
      },
      error: () => {

      }
    });
  }

  /**
   * **Check if the user is logged in or not**
   * @return {boolean} True if is logged | Flase if not
   */
  get isLoggedIn(): boolean {
    let access_token_cookie_exist: boolean = this.CookieService.check('access_token');
    let user_cookie_exist: boolean = this.CookieService.check('access_token');
    try {
      if (access_token_cookie_exist && user_cookie_exist){
        let user: any = JSON.parse(this.CookieService.get('user'));
        this.logged_user = true;
        this.current_user = user;
        return true;
      } else {
        this.logged_user = false; 
        this.current_user = new User();
        return false;
      }
    } catch(error) {
      this.logged_user = false; 
      this.current_user = new User();
      return false
    }
  }


  /**
   * **Save user info in cookies**
   * @param {user} user User to save in cookies
   * @return {boolean} Return true if cookie created or false if not
   */
  setUserCookie(user: User): boolean{
    try {
      this.CookieService.set('user', JSON.stringify(user))
      return true;
    } catch (e: any){
        return false;
    }
  }

  /**
   * **Get user info from cookies**
   * @return {User} Return user object
   */
  getUserInfo(): User {
    try {
      return JSON.parse(this.CookieService.get('user'))
    } catch (e: any){
      return new User();
    }
    
  }


  /**
   * **Save access token in cookies**
   * @param {string} access_token Access token to save
   * @return {boolean} Return ture if cookie created or false if not
   */
  setAccessTokenCookie(access_token: string): boolean {
      try {
        this.CookieService.set('access_token', access_token)
        return true;
      } catch (e: any){
          return false;
      }
      
  }

  /**
   * **Get access_token from cookies**
   * @return {string | null} Return access token or null if throw error
   */
    getAccessToken(): string | null {
    try {
      return this.CookieService.get('access_token');
    } catch (e: any){
      return null;
    }
  }

  /**
   * **Delete cookies related with logged user**
   */
  deleteSessionCookies(): void {
    this.CookieService.deleteAll()
  }

}
