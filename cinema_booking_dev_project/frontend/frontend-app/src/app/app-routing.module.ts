import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './pages/home/home.component';
import { BookingsComponent } from './pages/bookings/bookings.component';
import { ConfirmationComponent } from './pages/confirmation/confirmation.component';
import { LoginComponent } from './pages/login/login.component';
import { ViewBookingsComponent } from './pages/view-bookings/view-bookings.component';

const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'bookings', component: BookingsComponent },
  { path: 'confirmation', component: ConfirmationComponent },
  { path: 'login', component: LoginComponent },
  { path: 'view-bookings', component: ViewBookingsComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
