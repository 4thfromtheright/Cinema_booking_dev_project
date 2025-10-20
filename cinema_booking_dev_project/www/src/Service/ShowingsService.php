<?php

namespace App\Service;

use App\Repository\CbBookingRepository;
use App\Repository\CbFilmsRepository;
use App\Repository\CbShowingsRepository;
use App\Repository\CbUsersRepository;
use App\Repository\CbSeatsRepository;
use App\Service\Interfaces\ShowingsServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class ShowingsService implements ShowingsServiceInterface
{
    private $showingsRepository;
    private $filmsRepository;
    private $bookingRepository;
    private $usersRepository;
    private $seatsRepository;
    private $em;

    public function __construct(
        EntityManagerInterface $em,
        CbBookingRepository $bookingRepository,
        CbShowingsRepository $showingsRepository,
        CbFilmsRepository $filmsRepository,
        CbUsersRepository $usersRepository,
        CbSeatsRepository $seatsRepository
    ) {
        $this->em = $em;
        $this->bookingRepository = $bookingRepository;
        $this->showingsRepository = $showingsRepository;
        $this->filmsRepository = $filmsRepository;
        $this->usersRepository = $usersRepository;
        $this->seatsRepository = $seatsRepository;
    }



    public function getAllShowings()
    {
        $showings = $this->showingsRepository->findAll();
        if (!$showings) {
            throw new Exception('Showings not found');
        }
        return $showings;
    }

    public function getShowingsByTheater($theaterId)
    {
        $showings = $this->showingsRepository->findBy(['theater' => $theaterId]);
        if (!$showings) {
            throw new Exception('Showings not found');
        }
        return $showings;
    }

    public function getShowingsByFilm($filmId)
    {
        $film = $this->filmsRepository->find($filmId);
        if (!$film) {
            throw new Exception('Film not found');
        }

        $showings = $this->showingsRepository->findBy(['film' => $film]);
        if (!$showings) {
            throw new Exception('Showings not found');
        }
        return $showings;
    }

    public function getShowingById($id)  //maybe works
    {
        $showing = $this->showingsRepository->find($id);
        if (!$showing) {
            throw new \Exception("Showing not found");
        }

        $theater = $showing->getTheater();
        $allSeats = $theater->getSeats()->toArray();


        $bookings = $this->bookingRepository->findBy(['showing' => $showing]);


        $bookedSeats =
            array_map(fn($b) => $b->getSeat()->getSeatID(), $bookings);


        $seatsArray = array_map(function($seat) use ($bookedSeats) {
            return [
                'id' => $seat->getSeatId(),
                'number' => $seat->getSeatNumber(),
                'booked' => in_array($seat->getSeatId(), $bookedSeats)
            ];
        }, $allSeats);

        return [
            'id' => $showing->getShowingId(),
            'film' => [
                'id' => $showing->getFilm()->getFilmId(),
                'title' => $showing->getFilm()->getTitle()
            ],
            'theater' => [
                'id' => $theater->getTheaterId(),
                'name' => $theater->getName()
            ],
            'showTime' => $showing->getShowTime()->format('Y-m-d H:i:s'),
            'seats' => $seatsArray
        ];
    }



    public function bookSeats(int $showingId, int $userId, array $seatNumbers)
    {
        $showing = $this->showingsRepository->find($showingId);
        $user = $this->usersRepository->find($userId);

        if (!$showing) {
            throw new \Exception("Showing not found");
        }
        if (!$user) {
            throw new \Exception("User not found");
        }

        $bookedSeats = [];

        foreach ($seatNumbers as $seatNumber) {
            // Find seat by theater + seat number
            $seat = $this->seatsRepository->findOneBy([
                'theater' => $showing->getTheater(),
                'seatNumber' => $seatNumber
            ]);

            if (!$seat) {
                throw new \Exception("Seat {$seatNumber} not found in this theater");
            }

            // Check if already booked
            $existing = $this->bookingRepository->findOneBy([
                'showing' => $showing,
                'seat' => $seat
            ]);

            if ($existing) {
                throw new \Exception("Seat {$seatNumber} is already booked");
            }

            $booking = new \App\Entity\CbBooking();
            $booking->setShowing($showing)
                ->setUser($user)
                ->setSeat($seat)
                ->setConfirmationCode($this->generateConfirmationCode())
                ->setBookingTime(new \DateTime());

            $this->em->persist($booking);
            $bookedSeats[] = $seatNumber;
        }

        $this->em->flush();

        return [
            'confirmationCode' => $booking->getConfirmationCode(),
            'bookedSeats' => $bookedSeats
        ];
    }


    // -------------------------------
    // Helpers
    // -------------------------------

    private function generateConfirmationCode(): string
    {
        return strtoupper(substr(md5(uniqid('', true)), 0, 8));
    }
}
