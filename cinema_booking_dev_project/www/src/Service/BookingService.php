<?php

namespace App\Service;

use App\Entity\CbBooking;
use App\Factory\CbBookingFactory;
use App\Repository\CbBookingRepository;
use App\Repository\CbShowingsRepository;
use App\Service\Interfaces\BookingServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

class BookingService implements BookingServiceInterface
{
    private $bookingRepo;
    private $bookingFactory;
    private $em;
    private $showingsRepository;

    public function __construct(CbBookingRepository $bookingRepo, CbBookingFactory $bookingFactory,CbShowingsRepository $showingsRepository, EntityManagerInterface $em)
    {
        $this->bookingRepo = $bookingRepo;
        $this->bookingFactory = $bookingFactory;
        $this->showingsRepository = $showingsRepository;
        $this->em = $em;
    }

    /**
     * @throws \Exception
     */
    public function createBooking(array $data)
    {
        return $this->bookingFactory->createMultiple($data);
    }

    public function getBookingById(int $id)
    {
        return $this->bookingRepo->find($id);
    }

    public function getBookingsByUser(int $userId)
    {
        return $this->bookingRepo->findBy(['user' => $userId]);
    }

    public function cancelBooking(int $id): bool
    {
        $booking = $this->bookingRepo->find($id);
        if (!$booking) {
            throw new \Exception('Booking not found');
        }
        $this->bookingRepo->remove($booking);
        return true;
    }


    public function bookSeats( $showingId,  $userId,  $seatNumbers): array
    {
        $showing = $this->showingsRepository->find($showingId);
        $user = $this->showingsRepository->find($userId);

        if (!$showing) {
            throw new \Exception('Showing not found.');
        }
        if (!$user) {
            throw new \Exception('User not found.');
        }

        // Generate a single confirmation code
        $confirmationCode = strtoupper(bin2hex(random_bytes(4))); // 8-char code

        $bookedSeats = [];

        foreach ($seatNumbers as $seatNumber) {
            // Check if seat is already booked
            $existing = $this->em->getRepository(CbBooking::class)
                ->findOneBy(['showing' => $showing, 'seatNumber' => $seatNumber]);

            if ($existing) {
                throw new \Exception("Seat $seatNumber is already booked.");
            }

            $booking = new CbBooking();
            $booking->setUser($user)
                ->setShowing($showing)
                ->setSeatNumber($seatNumber)
                ->setConfirmationCode($confirmationCode);

            $this->em->persist($booking);
            $bookedSeats[] = $seatNumber;
        }

        $this->em->flush();

        return [
            'confirmationCode' => $confirmationCode,
            'bookedSeats' => $bookedSeats
        ];
    }
}
