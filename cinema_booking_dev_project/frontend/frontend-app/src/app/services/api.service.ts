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
   return this.http.get<any[]>(`${this.apiUrl}/theaters/${cinemaId}/theaters`);
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
    return this.http.get<any[]>(`${this.apiUrl}/user/bookings/${ user.userId}`, { headers: this.authHeaders() }); 
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

  getUserById(userId: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/users/${userId}`); 
  }

  getHomeData(): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/home`);
  }
}