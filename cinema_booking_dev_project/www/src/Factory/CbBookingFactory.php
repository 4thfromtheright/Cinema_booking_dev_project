<?php

namespace App\Factory;

use App\Entity\CbBooking;
use Doctrine\ORM\EntityManagerInterface;

class CbBookingFactory implements FactoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create( $data)
    {
        if (!isset($data['userId']) || !isset($data['showingId']) || !isset($data['seatIds']) || !is_array($data['seatIds'])) {
            throw new \Exception("Missing or invalid booking data (userId, showingId, seatIds).");
        }

        $user = $this->em->getRepository(\App\Entity\CbUsers::class)->find($data['userId']);
        if (!$user) {
            throw new \Exception("User not found for ID " . $data['userId']);
        }

        $showing = $this->em->getRepository(\App\Entity\CbShowings::class)->find($data['showingId']);
        if (!$showing) {
            throw new \Exception("Showing not found for ID " . $data['showingId']);
        }

        $seatRepo = $this->em->getRepository(\App\Entity\CbSeats::class);
        $createdBookings = [];

        foreach ($data['seatIds'] as $seatId) {
            $seat = $seatRepo->find($seatId);
            if (!$seat) {
                throw new \Exception("Seat not found for ID " . $seatId);
            }

            // create a new booking for each seat
            $booking = new \App\Entity\CbBooking();
            $booking->setUser($user);
            $booking->setShowing($showing);
            $booking->setSeat($seat);
            $booking->setConfirmationCode($this->generateConfirmationCode());
            $booking->setBookingTime(new \DateTime());

            $this->em->persist($booking);
            $createdBookings[] = $booking;
        }

        $this->em->flush();

        return $createdBookings;
    }




    public function getById($id)
    {
        return $this->em->getRepository(CbBooking::class)->find($id);
    }

    public function getBy(array $criteria)
    {
        return $this->em->getRepository(CbBooking::class)->findBy($criteria);
    }

    public function update(CbBooking $booking, array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($booking, $method)) {
                $booking->$method($value !== '' ? $value : null);
            }
        }

        // Ensure required fields are still set
        if (!$booking->getConfirmationCode()) {
            $booking->setConfirmationCode($this->generateConfirmationCode());
        }

        if (!$booking->getBookingTime()) {
            $booking->setBookingTime(new \DateTime());
        }

        $this->em->flush();
        return $booking;
    }

    public function delete(CbBooking $booking)
    {
        $this->em->remove($booking);
        $this->em->flush();
    }

    public function findAll()
    {
        return $this->em->getRepository(CbBooking::class)->findAll();
    }

    private function generateConfirmationCode(): string
    {
        return strtoupper(substr(md5(uniqid('', true)), 0, 8));
    }

    public function createMultiple(array $data): array
    {
        if (!isset($data['userId'], $data['showingId'], $data['seatIds']) || !is_array($data['seatIds'])) {
            throw new \Exception("Missing userId, showingId or seatIds");
        }

        $user = $this->em->getRepository(\App\Entity\CbUsers::class)->find($data['userId']);
        if (!$user) {
            throw new \Exception("User not found for ID {$data['userId']}");
        }

        $showing = $this->em->getRepository(\App\Entity\CbShowings::class)->find($data['showingId']);
        if (!$showing) {
            throw new \Exception("Showing not found for ID {$data['showingId']}");
        }

        // Check for existing bookings for these seats in this showing
        $existingBookings = $this->em->getRepository(\App\Entity\CbBooking::class)
            ->findBy([
                'showing' => $showing,
                'seat' => $data['seatIds']
            ]);

        if (!empty($existingBookings)) {
            $occupiedSeats = [];
            foreach ($existingBookings as $existing) {
                $occupiedSeats[] = $existing->getSeat()->getSeatId();
            }
            throw new \Exception("The following seats are already booked for this showing: " . implode(', ', $occupiedSeats));
        }

        $createdBookings = [];

        foreach ($data['seatIds'] as $seatId) {
            $seat = $this->em->getRepository(\App\Entity\CbSeats::class)->find($seatId);
            if (!$seat) {
                throw new \Exception("Seat not found for ID {$seatId}");
            }

            // Double-check if this specific seat is already booked for this showing
            $existingBooking = $this->em->getRepository(\App\Entity\CbBooking::class)
                ->findOneBy([
                    'showing' => $showing,
                    'seat' => $seat
                ]);

            if ($existingBooking) {
                throw new \Exception("Seat {$seatId} is already booked for this showing");
            }

            $booking = new \App\Entity\CbBooking();
            $booking->setUser($user)
                ->setShowing($showing)
                ->setSeat($seat)
                ->setBookingTime(new \DateTime())
                ->setConfirmationCode($this->generateConfirmationCode());

            $this->em->persist($booking);
            $createdBookings[] = $booking;
        }

        $this->em->flush();

        return $createdBookings;
    }





}
