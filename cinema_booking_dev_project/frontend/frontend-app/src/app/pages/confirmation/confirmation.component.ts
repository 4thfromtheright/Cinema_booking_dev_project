import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-confirmation',
  templateUrl: './confirmation.component.html',
})
export class ConfirmationComponent implements OnInit {
  showing: any = null;
  confirmationCodes: string[] = [];
  seatNumbers: string[] = [];

  constructor(
    private route: ActivatedRoute,
    private router: Router
  ) {}

  ngOnInit() {
    // Get all parameters
    const showingId = this.route.snapshot.queryParamMap.get('showingId');
    const codesParam = this.route.snapshot.queryParamMap.get('confirmationCodes');
    const seatsParam = this.route.snapshot.queryParamMap.get('seatNumbers');
    const filmTitle = this.route.snapshot.queryParamMap.get('filmTitle');
    const theaterName = this.route.snapshot.queryParamMap.get('theaterName');
    const showTime = this.route.snapshot.queryParamMap.get('showTime');

    console.log('Raw query params:', { // Debug log
      showingId, codesParam, seatsParam, filmTitle, theaterName, showTime
    });

    // Parse arrays from comma-separated strings
    this.confirmationCodes = codesParam ? codesParam.split(',') : [];
    this.seatNumbers = seatsParam ? seatsParam.split(',') : [];
    
    console.log('Parsed data:', { // Debug log
      confirmationCodes: this.confirmationCodes,
      seatNumbers: this.seatNumbers
    });

    // Reconstruct showing object
    this.showing = {
      film: { title: filmTitle || 'Unknown' },
      theater: { name: theaterName || 'Unknown' },
      showTime: showTime || new Date().toISOString()
    };

    if (!showingId || this.confirmationCodes.length === 0) {
      console.log('Invalid navigation - redirecting home');
      this.router.navigate(['/']);
      return;
    }
  }

  backToHome() {
    this.router.navigate(['/']);
  }
}