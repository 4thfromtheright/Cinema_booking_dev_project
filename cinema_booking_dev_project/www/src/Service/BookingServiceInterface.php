<?php
namespace App\Service;

use App\Entity\CbUsers;

interface BookingServiceInterface
{
    public function createBooking(CbUsers $user, array $data);
    public function getUserBookings(CbUsers $user): array;
    public function cancelBooking(CbUsers $user, int $bookingId);
}
