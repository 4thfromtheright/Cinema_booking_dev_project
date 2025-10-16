<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CbCinema
 *
 * @ORM\Table(name="CB_CINEMA")
 * @ORM\Entity
 */
class CbCinema
{
    /**
     * @var int
     *
     * @ORM\Column(name="cinema_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cinemaId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     */
    private $location;

    public function getCinemaId(): ?int
    {
        return $this->cinemaId;
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }


}
