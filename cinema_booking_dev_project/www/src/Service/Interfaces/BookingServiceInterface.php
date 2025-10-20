<?php

namespace App\Service\Interfaces;

interface BookingServiceInterface
{

    public function bookSeats(int $showingId, int $userId, array $seatNumbers): array;
}
