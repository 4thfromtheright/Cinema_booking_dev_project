import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html'
})
export class HomeComponent implements OnInit {
  cinemas: any[] = [];
  theaters: any[] = [];
  films: any[] = [];
  showings: any[] = [];
  selectedCinema: any = null;
  selectedTheater: any = null;
  selectedFilm: any = null;

  constructor(private api: ApiService, private router: Router) {}
  
isLoggedIn(): boolean {
  return this.api.isLoggedIn();
}

goToLogin() {
  this.router.navigate(['/login']);
}

goToBookings() {
  this.router.navigate(['/view-bookings']);
}

  ngOnInit() {
    this.api.getCinemas().subscribe(data => this.cinemas = data);
  }

  selectCinema(cinema: any) {
    this.selectedCinema = cinema;
    this.api.getTheaters(cinema.cinemaId).subscribe(data => this.theaters = data);
    this.films = [];
    this.showings = [];
  }

  selectTheater(theater: any) {
    this.selectedTheater = theater;
    this.api.getFilms(theater.theaterId).subscribe(data => this.films = data);
    this.showings = [];
  }

  selectFilm(film: any) {
    this.selectedFilm = film;
    this.api.getShowings(film.filmId).subscribe(data => this.showings = data);
  }

book(showing: any) {
  if (!this.api.isLoggedIn()) {
    this.router.navigate(['/login']);
  } else {
    this.router.navigate(['/bookings'], { queryParams: { showingId: showing.showingId } });
  }
}


}
