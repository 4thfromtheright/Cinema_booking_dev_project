// src/app/pages/view-bookings/view-bookings.component.ts
import { Component, OnInit,ChangeDetectorRef  } from '@angular/core';
import { ApiService } from '../../services/api.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-view-bookings',
  templateUrl: './view-bookings.component.html',
})
export class ViewBookingsComponent implements OnInit {
  bookings: any[] = [];

  constructor(private api: ApiService, private router: Router,    private cdRef: ChangeDetectorRef) {}

  ngOnInit() {
    const user = this.api.getSessionUser();
    if (user) {
      this.api.getBookings().subscribe({
        next: data => this.bookings = data,
        error: err => console.error('Failed to fetch bookings', err)
      });
    }
  }

  cancel(id: number) {
    this.api.cancelBooking(id).subscribe({
      next: () => {
        this.bookings = this.bookings.filter(b => b.bookingId !== id);
          alert('Booking cancelled successfully!');
          this.cdRef.detectChanges();
      },
      error: err => console.error('Failed to cancel booking', err)
    });
  }

    trackByBookingId(index: number, booking: any): number {
    return booking.bookingId;
  }

  goToLogin(){
  this.router.navigate(['/login']);

  }

  isLoggedIn(){
    return this.api.isLoggedIn();
  }
}
