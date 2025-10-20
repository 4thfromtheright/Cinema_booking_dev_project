import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-bookings',
  templateUrl: './bookings.component.html'
})
export class BookingsComponent implements OnInit {
  showingId: number = 0;
  showing: any = null;
  selectedSeats: number[] = [];
  availableSeats: number[] = [];

  constructor(
    private api: ApiService,
    private router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit() {
    this.showingId = Number(this.route.snapshot.queryParamMap.get('showingId'));
    if (!this.showingId) {
      this.router.navigate(['/']);
      return;
    }

    this.api.getShowing(this.showingId).subscribe(data => {
      this.showing = data;
      // Assuming showing.seats is an array of all seats with availability
      this.availableSeats = this.showing.seats.filter((s: any) => !s.booked).map((s: any) => s.number);
    });
  }

  toggleSeat(seat: number) {
    const index = this.selectedSeats.indexOf(seat);
    if (index > -1) {
      this.selectedSeats.splice(index, 1);
    } else {
      this.selectedSeats.push(seat);
    }
  }

  bookNow() {
    if (this.selectedSeats.length === 0) return;

    // Navigate to confirmation page with query params
    this.router.navigate(['/confirmation'], { 
      queryParams: { showingId: this.showingId, seats: this.selectedSeats.join(',') } 
    });
  }

  back() {
    this.router.navigate(['/']);
  }

  seatClass(seat: number) {
    return this.selectedSeats.includes(seat) ? 'seat-selected' : '';
  }
}
