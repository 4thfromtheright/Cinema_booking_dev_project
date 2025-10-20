<?php

namespace App\Controller;

use App\Utils\EntityMapperUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\BookingService;

class UserBookingsController extends AbstractController
{
    private $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * @Route("/api/user/bookings/{userId}", name="api_user_bookings", methods={"GET"})
     */
    public function getUserBookings(int $userId): JsonResponse
    {
        $bookings = $this->bookingService->getBookingsByUser($userId);
        return $this->json(    EntityMapperUtils::mapEntitiesToArrays($bookings,'booking'));
    }
}
