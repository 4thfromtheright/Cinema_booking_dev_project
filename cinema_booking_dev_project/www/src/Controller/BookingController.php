<?php

namespace App\Controller;

use App\Service\Interfaces\BookingServiceInterface;
use App\Utils\EntityMapperUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/bookings")
 */
class BookingController extends AbstractController
{
    private BookingServiceInterface $bookingService;

    public function __construct(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * @Route("/", name="create_booking", methods={"POST"})
     */
    public function createBooking(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $bookings = $this->bookingService->createBooking($data);

        $responseData = array_map(function ($b) {
            return EntityMapperUtils::mapBookingToArray($b);
        }, $bookings);

        return new JsonResponse($responseData, JsonResponse::HTTP_CREATED);
    }

    /**
     * @Route("/user/{userId}", name="get_user_bookings", methods={"GET"})
     */
    public function getUserBookings(int $userId): JsonResponse
    {
        $bookings = $this->bookingService->getBookingsByUser($userId);
        return new JsonResponse(EntityMapperUtils::mapEntitiesToArrays($bookings, 'booking'));
    }

    /**
     * @Route("/{id}", name="cancel_booking", methods={"DELETE"})
     */
    public function cancelBooking(int $id): JsonResponse
    {
        $result = $this->bookingService->cancelBooking($id);
        return new JsonResponse($result);
    }
}
