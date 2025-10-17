<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FactoryServiceProviderInterface;

class UserBookingsController extends AbstractController
{
    private $factoryProvider;

    public function __construct(FactoryServiceProviderInterface $factoryProvider)
    {
        $this->factoryProvider = $factoryProvider;
    }

    /**
     * @Route("/api/users/{id}/bookings", name="api_user_bookings", methods={"GET"})
     */
    public function index($id): JsonResponse
    {
        $bookings = $this->factoryProvider->getBookingFactory()->getBy(['user' => $id]);
        return $this->json($bookings);
    }

    /**
     * @Route("/api/users/{id}/bookings/{bookingId}", name="api_user_booking_cancel", methods={"DELETE"})
     */
    public function cancel($id, $bookingId): JsonResponse
    {
        $booking = $this->factoryProvider->getBookingFactory()->getById($bookingId);
        if (!$booking) {
            return $this->json(['error' => 'Booking not found'], 404);
        }

        if ($booking->getUser()->getUserId() != $id) {
            return $this->json(['error' => 'Forbidden'], 403);
        }

        $this->factoryProvider->getBookingFactory()->delete($booking);
        return $this->json(['success' => true]);
    }
}
