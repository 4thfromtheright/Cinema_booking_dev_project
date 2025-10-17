<?php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class BookingService implements BookingServiceInterface
{
    private $factoryProvider;
    private $em;

    public function __construct(FactoryServiceProviderInterface $factoryProvider, EntityManagerInterface $em)
    {
        $this->factoryProvider = $factoryProvider;
        $this->em = $em;
    }

    public function createBooking($user, array $data)
    {
        $bookingFactory = $this->factoryProvider->getBookingFactory();

        $booking = $bookingFactory->create([
            'user' => $user,
            'showing' => $this->em->getReference('App\Entity\CbShowings', $data['showing_id']),
            'seat' => $this->em->getReference('App\Entity\CbSeats', $data['seat_id']),
        ]);

        return $booking;
    }

    public function getUserBookings($user): array
    {
        $bookingFactory = $this->factoryProvider->getBookingFactory();

        $bookings = $bookingFactory->findBy(['user' => $user]);

        $result = [];
        foreach ($bookings as $booking) {
            $result[] = [
                'id' => $booking->getId(),
                'showing' => $booking->getShowing()->getFilm()->getTitle(),
                'cinema' => $booking->getShowing()->getTheater()->getCinema()->getName(),
                'seat' => $booking->getSeat()->getSeatNumber(),
                'time' => $booking->getShowing()->getShowTime()->format('Y-m-d H:i'),
            ];
        }
        return $result;
    }

    public function cancelBooking($user, int $bookingId)
    {
        $bookingFactory = $this->factoryProvider->getBookingFactory();
        $booking = $bookingFactory->find($bookingId);

        if (!$booking || $booking->getUser()->getId() !== $user->getId()) {
            throw new \Exception('Booking not found or not yours');
        }

        $bookingFactory->remove($booking);
    }
}
