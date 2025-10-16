<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CbFilms
 *
 * @ORM\Table(name="CB_FILMS")
 * @ORM\Entity
 */
class CbFilms
{
    /**
     * @var int
     *
     * @ORM\Column(name="film_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $filmId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="genre", type="string", length=50, nullable=true)
     */
    private $genre;

    /**
     * @var int|null
     *
     * @ORM\Column(name="duration_minutes", type="integer", nullable=true)
     */
    private $durationMinutes;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    public function getFilmId(): ?int
    {
        return $this->filmId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDurationMinutes(): ?int
    {
        return $this->durationMinutes;
    }

    public function setDurationMinutes(?int $durationMinutes): self
    {
        $this->durationMinutes = $durationMinutes;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }


}
