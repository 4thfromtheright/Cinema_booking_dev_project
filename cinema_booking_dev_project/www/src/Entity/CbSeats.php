<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CbSeats
 *
 * @ORM\Table(name="CB_SEATS", uniqueConstraints={@ORM\UniqueConstraint(name="theater_id", columns={"theater_id", "seat_number"})}, indexes={@ORM\Index(name="IDX_62E8A6E8D70E4479", columns={"theater_id"})})
 * @ORM\Entity
 */
class CbSeats
{
    /**
     * @var int
     *
     * @ORM\Column(name="seat_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $seatId;

    /**
     * @var string
     *
     * @ORM\Column(name="seat_number", type="string", length=10, nullable=false)
     */
    private $seatNumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="row_label", type="string", length=5, nullable=true)
     */
    private $rowLabel;

    /**
     * @var \CbTheater
     *
     * @ORM\ManyToOne(targetEntity="CbTheater")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="theater_id", referencedColumnName="theater_id")
     * })
     */
    private $theater;

    public function getSeatId(): ?int
    {
        return $this->seatId;
    }

    public function getSeatNumber(): ?string
    {
        return $this->seatNumber;
    }

    public function setSeatNumber(string $seatNumber): self
    {
        $this->seatNumber = $seatNumber;

        return $this;
    }

    public function getRowLabel(): ?string
    {
        return $this->rowLabel;
    }

    public function setRowLabel(?string $rowLabel): self
    {
        $this->rowLabel = $rowLabel;

        return $this;
    }

    public function getTheater(): ?CbTheater
    {
        return $this->theater;
    }

    public function setTheater(?CbTheater $theater): self
    {
        $this->theater = $theater;

        return $this;
    }


}
