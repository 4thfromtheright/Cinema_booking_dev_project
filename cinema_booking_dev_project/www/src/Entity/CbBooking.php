<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CbBooking
 *
 * @ORM\Table(
 *     name="CB_BOOKING",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="showing_seat_unique", columns={"showing_id", "seat_id"})},
 *     indexes={@ORM\Index(name="user_idx", columns={"user_id"}), @ORM\Index(name="showing_idx", columns={"showing_id"})}
 * )
 * @ORM\Entity
 */
class CbBooking
{
    /**
     * @var int
     *
     * @ORM\Column(name="booking_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bookingId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="booking_time", type="datetime", nullable=false)
     */
    private $bookingTime;

    /**
     * @var \CbUsers
     *
     * @ORM\ManyToOne(targetEntity="CbUsers")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @var \CbShowings
     *
     * @ORM\ManyToOne(targetEntity="CbShowings")
     * @ORM\JoinColumn(name="showing_id", referencedColumnName="showing_id")
     */
    private $showing;

    /**
     * @var \CbSeats
     *
     * @ORM\ManyToOne(targetEntity="CbSeats")
     * @ORM\JoinColumn(name="seat_id", referencedColumnName="seat_id")
     */
    private $seat;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmation_code", type="string", length=20, nullable=false)
     */
    private $confirmationCode;

    public function __construct()
    {
        $this->bookingTime = new \DateTime();
    }

    public function getBookingId(): ?int
    {
        return $this->bookingId;
    }

    public function getBookingTime(): ?\DateTimeInterface
    {
        return $this->bookingTime;
    }

    public function setBookingTime(\DateTimeInterface $bookingTime): self
    {
        $this->bookingTime = $bookingTime;
        return $this;
    }

    public function getUser(): ?CbUsers
    {
        return $this->user;
    }

    public function setUser(?CbUsers $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getShowing(): ?CbShowings
    {
        return $this->showing;
    }

    public function setShowing(?CbShowings $showing): self
    {
        $this->showing = $showing;
        return $this;
    }

    public function getSeat(): ?CbSeats
    {
        return $this->seat;
    }

    public function setSeat(?CbSeats $seat): self
    {
        $this->seat = $seat;
        return $this;
    }

    public function getConfirmationCode(): ?string
    {
        return $this->confirmationCode;
    }

    public function setConfirmationCode(string $confirmationCode): self
    {
        $this->confirmationCode = $confirmationCode;
        return $this;
    }
}
