<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="CB_SHOWINGS")
 */
class CbShowings
{
    /** @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer") */
    private $showingId;

    /** @ORM\ManyToOne(targetEntity="App\Entity\CbTheater") @ORM\JoinColumn(name="theater_id", referencedColumnName="theater_id") */
    private $theater;

    /** @ORM\ManyToOne(targetEntity="App\Entity\CbFilms") @ORM\JoinColumn(name="film_id", referencedColumnName="film_id") */
    private $film;

    /** @ORM\Column(type="datetime") */
    private $showTime;

    /** @ORM\OneToMany(targetEntity="App\Entity\CbBooking", mappedBy="showing") */
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getShowingId(): ?int { return $this->showingId; }
    public function getTheater(): ?CbTheater { return $this->theater; }
    public function setTheater(?CbTheater $theater): self { $this->theater = $theater; return $this; }

    public function getFilm(): ?CbFilms { return $this->film; }
    public function setFilm(?CbFilms $film): self { $this->film = $film; return $this; }

    public function getShowTime(): ?\DateTimeInterface { return $this->showTime; }
    public function setShowTime(\DateTimeInterface $showTime): self { $this->showTime = $showTime; return $this; }

    public function getBookings(): Collection { return $this->bookings; }
    public function addBooking(CbBooking $booking): self { $this->bookings[] = $booking; $booking->setShowing($this); return $this; }
    public function removeBooking(CbBooking $booking): self { $this->bookings->removeElement($booking); return $this; }

    public function getSeats(): array
    {
        if (!$this->theater) return [];
        $seats = $this->theater->getSeats()->toArray();
        $bookedSeatNumbers = $this->bookings->map(fn($b) => $b->getSeatNumber())->toArray();

        return array_map(fn($seat) => [
            'seatId' => $seat->getSeatId(),
            'seatNumber' => $seat->getSeatNumber(),
            'booked' => in_array($seat->getSeatNumber(), $bookedSeatNumbers)
        ], $seats);
    }
}
