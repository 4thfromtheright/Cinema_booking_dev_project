<?php

namespace App\Controller;

use App\Service\BookingService;
use App\Utils\EntityMapperUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmationController
{
    private $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * @Route("/api/bookings/confirm/{id}", name="booking_confirmation", methods={"GET"})
     */
    public function confirm(int $id)
    {
        try {
            $booking = $this->bookingService->getBookingById($id);
            return EntityMapperUtils::mapBookingToArray($booking);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 404);
        }
    }
}
