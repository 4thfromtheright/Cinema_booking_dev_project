<?php
// src/Controller/BookingController.php
namespace App\Controller;

use App\Service\BookingServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class BookingController extends AbstractController
{
    private $bookingService;
    private $security;

    public function __construct(BookingServiceInterface $bookingService, Security $security)
    {
        $this->bookingService = $bookingService;
        $this->security = $security;
    }

    /**
     * @Route("/api/bookings", name="create_booking", methods={"POST"})
     */
    public function createBooking(Request $request): JsonResponse
    {
        $user = $this->security->getUser();

        // Ensure the logged-in user is an actual CbUsers entity
        if (!$user instanceof \App\Entity\CbUsers) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }

        $data = json_decode($request->getContent(), true);

        try {
            $booking = $this->bookingService->createBooking($user, $data);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }

        return $this->json([
            'message' => 'Booking created',
            'booking_id' => $booking->getId(),
        ], 201);
    }

    /**
     * @Route("/api/bookings", name="view_bookings", methods={"GET"})
     */
    public function viewBookings(): JsonResponse
    {
        $user = $this->security->getUser();

        // Ensure the logged-in user is an actual CbUsers entity
        if (!$user instanceof \App\Entity\CbUsers) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }


        $bookings = $this->bookingService->getUserBookings($user);

        return $this->json($bookings);
    }

    /**
     * @Route("/api/bookings/{id}", name="cancel_booking", methods={"DELETE"})
     */
    public function cancelBooking(int $id): JsonResponse
    {
        $user = $this->security->getUser();

        // Ensure the logged-in user is an actual CbUsers entity
        if (!$user instanceof \App\Entity\CbUsers) {
            return $this->json(['error' => 'Unauthorized'], 401);
        }
        try {
            $this->bookingService->cancelBooking($user, $id);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }

        return $this->json(['message' => 'Booking cancelled']);
    }
}
