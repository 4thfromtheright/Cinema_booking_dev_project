<?php

namespace App\Service;

interface BookingServiceInterface
{
    public function createBooking(array $data);
    public function getBookingById(int $id);
    public function getBookingsByUser(int $userId);
    public function cancelBooking(int $id);
}
