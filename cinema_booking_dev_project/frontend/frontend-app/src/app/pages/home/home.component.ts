import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html'
})
export class HomeComponent implements OnInit {
  homePage: any={};
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
    this.api.getHomeDatacached().subscribe({
      next: (data) => {
   
        this.homePage = data;
        this.cinemas = data.cinemas || [];    
      },
      error: (err) => {
        console.error('Error loading home data:', err);
      }
    });
  }


  selectCinema(cinema: any) {
    this.selectedCinema = cinema;
    const cinemaId = cinema.cinemaId;

    // Filter theaters that belong to this cinema
    this.theaters = (this.homePage.theaters || []).filter(
      (theater: any) => theater.cinemaId === cinemaId
    );

    this.films = [];
    this.showings = [];
    this.selectedTheater = null;
    this.selectedFilm = null;
  }
   selectTheater(theater: any) {
    this.selectedTheater = theater;
    const theaterId = theater.theaterId;

    // Filter showings that belong to this theater
    this.showings = (this.homePage.showings || []).filter(
      (showing: any) => showing.theaterId === theaterId
    );

    // From those showings, get the related films (avoid duplicates)
    const filmIds = new Set(this.showings.map((s: any) => s.filmId));
    this.films = (this.homePage.films || []).filter((film: any) =>
      filmIds.has(film.filmId)
    );

    this.selectedFilm = null;
  }

  selectFilm(film: any) {
    this.selectedFilm = film;
    const filmId = film.filmId;
    const theaterId = this.selectedTheater?.theaterId;

    this.showings = (this.homePage.showings || []).filter(
      (showing: any) =>
        showing.filmId === filmId && showing.theaterId === theaterId
    );
  }

book(showing: any) {
  if (!this.api.isLoggedIn()) {
    this.router.navigate(['/login']);
  } else {
    this.router.navigate(['/bookings'], { queryParams: { showingId: showing.showingId } });
  }
}


}
