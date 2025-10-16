<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CbTheater
 *
 * @ORM\Table(name="CB_THEATER", indexes={@ORM\Index(name="cinema_id", columns={"cinema_id"})})
 * @ORM\Entity
 */
class CbTheater
{
    /**
     * @var int
     *
     * @ORM\Column(name="theater_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $theaterId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="seat_count", type="integer", nullable=false)
     */
    private $seatCount;

    /**
     * @var \CbCinema
     *
     * @ORM\ManyToOne(targetEntity="CbCinema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cinema_id", referencedColumnName="cinema_id")
     * })
     */
    private $cinema;

    public function getTheaterId(): ?int
    {
        return $this->theaterId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSeatCount(): ?int
    {
        return $this->seatCount;
    }

    public function setSeatCount(int $seatCount): self
    {
        $this->seatCount = $seatCount;

        return $this;
    }

    public function getCinema(): ?CbCinema
    {
        return $this->cinema;
    }

    public function setCinema(?CbCinema $cinema): self
    {
        $this->cinema = $cinema;

        return $this;
    }


}
