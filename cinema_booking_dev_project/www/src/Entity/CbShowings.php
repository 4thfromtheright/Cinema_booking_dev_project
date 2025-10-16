<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CbShowings
 *
 * @ORM\Table(name="CB_SHOWINGS", indexes={@ORM\Index(name="film_id", columns={"film_id"}), @ORM\Index(name="theater_id", columns={"theater_id"})})
 * @ORM\Entity
 */
class CbShowings
{
    /**
     * @var int
     *
     * @ORM\Column(name="showing_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $showingId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="show_time", type="datetime", nullable=false)
     */
    private $showTime;

    /**
     * @var \CbTheater
     *
     * @ORM\ManyToOne(targetEntity="CbTheater")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="theater_id", referencedColumnName="theater_id")
     * })
     */
    private $theater;

    /**
     * @var \CbFilms
     *
     * @ORM\ManyToOne(targetEntity="CbFilms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="film_id", referencedColumnName="film_id")
     * })
     */
    private $film;

    public function getShowingId(): ?int
    {
        return $this->showingId;
    }

    public function getShowTime(): ?\DateTimeInterface
    {
        return $this->showTime;
    }

    public function setShowTime(\DateTimeInterface $showTime): self
    {
        $this->showTime = $showTime;

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

    public function getFilm(): ?CbFilms
    {
        return $this->film;
    }

    public function setFilm(?CbFilms $film): self
    {
        $this->film = $film;

        return $this;
    }


}
