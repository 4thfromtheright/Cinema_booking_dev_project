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
  selectedSeatIds: number[] = [];
  selectedSeatNumbers: string[] = [];
  isBooking: boolean = false;

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
    });
  }

  toggleSeat(seat: any) {
    if (seat.booked) {
      return;
    }

    const index = this.selectedSeatIds.indexOf(seat.id);
    if (index > -1) {
      this.selectedSeatIds.splice(index, 1);
      this.selectedSeatNumbers.splice(index, 1);
    } else {
      this.selectedSeatIds.push(seat.id);
      this.selectedSeatNumbers.push(seat.number);
    }
  }

bookNow() {
  if (this.selectedSeatIds.length === 0 || this.isBooking) return;

  this.isBooking = true;
  
  this.api.bookSeats(this.showingId, this.selectedSeatIds).subscribe({
    next: (response) => {
      this.isBooking = false;
      console.log('Booking response:', response); // Debug log
      
      // The response should be an array of booking objects
      // Extract confirmation codes from each booking object
      const confirmationCodes = response.map((booking: any) => {
        console.log('Booking object:', booking); // Debug log
        return booking.confirmationCode;
      });
      
      console.log('Extracted codes:', confirmationCodes); // Debug log
      
      // Navigate with the data
      this.router.navigate(['/confirmation'], { 
        queryParams: { 
          showingId: this.showingId,
          confirmationCodes: confirmationCodes.join(','),
          seatNumbers: this.selectedSeatNumbers.join(','),
          filmTitle: this.showing.film.title,
          theaterName: this.showing.theater.name,
          showTime: this.showing.showTime
        } 
      });
    },
    error: (error) => {
      this.isBooking = false;
      console.error('Booking failed:', error);
      alert('Booking failed. Please try again.');
    }
  });
}

  back() {
    this.router.navigate(['/']);
  }
}