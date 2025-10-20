import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-confirmation',
  templateUrl: './confirmation.component.html',
})
export class ConfirmationComponent implements OnInit {
  showing: any = null;
  bookedSeats: number[] = [];
  confirmationCodes: string[] = [];

  constructor(
    private api: ApiService,
    private route: ActivatedRoute,
    private router: Router
  ) {}

  ngOnInit() {
    const showingId = Number(this.route.snapshot.queryParamMap.get('showingId'));
    const seatsParam = this.route.snapshot.queryParamMap.get('seats');
    this.bookedSeats = seatsParam ? seatsParam.split(',').map(s => Number(s)) : [];

    if (!showingId || this.bookedSeats.length === 0) {
      this.router.navigate(['/']);
      return;
    }

    this.api.getShowing(showingId).subscribe(data => (this.showing = data));

    console.log('Booking seats for user:', this.api.getSessionUser());

    this.api.bookSeats(showingId, this.bookedSeats).subscribe(res => {
      // res is now an array of bookings
      this.confirmationCodes = res.map((b: any) => b.confirmationCode);
    });
  }

  backToHome() {
    this.router.navigate(['/']);
  }
}
