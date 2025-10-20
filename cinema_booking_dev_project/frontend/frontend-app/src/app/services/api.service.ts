// src/app/services/api.service.ts
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import { tap } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private apiUrl = '/api';
  private currentUser: any = null;
 private homeDataCache :any=null;
  private homeBookingsCache :any=null;
 private cacheTimestamp: number = 0;
   private cacheInterval = 3 * 60 * 1000; // 3 minutes in ms
constructor(private http: HttpClient) {
  const savedUser = localStorage.getItem('currentUser');
  if (savedUser) {
    this.currentUser = JSON.parse(savedUser);
  }

}

  // Session helpers
  isLoggedIn(): boolean {
    return this.currentUser != null;
  }

  getSessionUser(): any {
    return this.currentUser;
  }

  getUser(): any {
    return this.currentUser;
  }

  logout() {
    this.currentUser = null;
  }

  private authHeaders(): HttpHeaders {
    return new HttpHeaders();
  }

  // Auth
login(email: string, password: string): Observable<any> {

  return this.http.post<any>(
    `${this.apiUrl}/auth/login`,
    { email, password }
  ).pipe(
    tap(user => {
      this.currentUser = user;
      localStorage.setItem('currentUser', JSON.stringify(user));
    })
  );
}

signup(username: string, email: string, password: string): Observable<any> {
  return this.http.post<any>(
    `${this.apiUrl}/auth/signup`,
    { name: username, email, password }
  ).pipe(
    tap(user => {
      this.currentUser = user;
      localStorage.setItem('currentUser', JSON.stringify(user));
    })
  );
}


  // Home page


  getCinemas(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/cinema/`);
  }

  getTheaters(cinemaId: number): Observable<any[]> {
   return this.http.get<any[]>(`${this.apiUrl}/theaters/${cinemaId}`);
  }

  getFilms(theaterId: number): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/theaters/${theaterId}/films`); 
  }

  getShowings(filmId: number): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/showings/film/${filmId}`); 
  }

 getShowing(id: number): Observable<any> {
  return this.http.get<any>(`${this.apiUrl}/showings/${id}`, { headers: this.authHeaders() });
}

bookSeats(showingId: number, seatIds: number[]) {
  const user = this.getSessionUser();

  const body = {
    userId: user?.userId,   // matches backend
    showingId: showingId,
    seatIds: seatIds
  };
console.log(body)
  return this.http.post<any>(`${this.apiUrl}/bookings/`, body);
}


  // View bookings
  getBookings(): Observable<any[]> {
  const user = this.getSessionUser();
  const now = Date.now();
    // If cached data exists and is still valid, return it
    if (this.homeBookingsCache && now - this.cacheTimestamp < this.cacheInterval) {
      return of(this.homeBookingsCache);
    }

    // Otherwise, fetch from API and cache it
    return  this.http.get<any[]>(`${this.apiUrl}/bookings/user/${ user.userId}`, { headers: this.authHeaders() }).pipe(
      tap(data => {
        this.homeBookingsCache = data;
        this.cacheTimestamp = Date.now();
      })
    );
  }
  

  cancelBooking(bookingId: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/bookings/${bookingId}`, { headers: this.authHeaders() });
  }

  getBookingById(bookingId: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/bookings/confirm/${bookingId}`, { headers: this.authHeaders() }); 
  }

  getAllFilms(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/films/`);
  }

  getFilmById(filmId: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/films/${filmId}`); 
  }

  getAllShowings(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/showings/`); 
  }

  getShowingsByTheater(theaterId: number): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/showings/theater/${theaterId}`); 
  }


getHomeDatacached(): Observable<any> {
    const now = Date.now();

    // If cached data exists and is still valid, return it
    if (this.homeDataCache && now - this.cacheTimestamp < this.cacheInterval) {
      return of(this.homeDataCache);
    }

    // Otherwise, fetch from API and cache it
    return  this.http.get<any>(`${this.apiUrl}/home/`).pipe(
      tap(data => {
        this.homeDataCache = data;
        this.cacheTimestamp = Date.now();
      })
    );
  }

}