import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html'
})
export class LoginComponent {
  name: string = '';
  email: string = '';
  password: string = '';
  isSignup: boolean = false;
  errorMessage: string = '';

  constructor(private api: ApiService, private router: Router) {}

  toggleMode() {
    this.isSignup = !this.isSignup;
    this.errorMessage = '';
  }

  submit() {
    if (this.isSignup) {
      this.api.signup(this.name, this.email, this.password).subscribe({
        next: () => {
          this.router.navigate(['/']);
        },
        error: err => {
          this.errorMessage = err.error?.message || 'Signup failed';
        }
      });
    } else {
      this.api.login(this.email, this.password).subscribe({
        next: () => {
          this.router.navigate(['/']);
        },
        error: err => {
          this.errorMessage = err.error?.message || 'Login failed';
        }
      });
    }
  }

  isLoggedIn(): boolean {
    return this.api.isLoggedIn();
  }

  goToBookings() {
    this.router.navigate(['/view-bookings']);
  }
}
