<?php

namespace App\Utils;

use App\Entity\CbBooking;
use App\Entity\CbCinema;
use App\Entity\CbFilms;
use App\Entity\CbSeats;
use App\Entity\CbShowings;
use App\Entity\CbTheater;
use App\Entity\CbUsers;

class EntityMapperUtils
{
    public static function mapBookingToArray(CbBooking $booking): array
    {
        return [
            'bookingId' => $booking->getBookingId(),
            'confirmationCode'=> $booking->getConfirmationCode(),
            'bookingTime' => $booking->getBookingTime()->format('Y-m-d H:i:s'),
            'userId' => $booking->getUser() ? $booking->getUser()->getUserId() : null,
            'userName' => $booking->getUser() ? $booking->getUser()->getName() : null,
            'showingId' => $booking->getShowing() ? $booking->getShowing()->getShowingId() : null,
            'showTime' => $booking->getShowing() ? $booking->getShowing()->getShowTime()->format('Y-m-d H:i:s') : null,
            'filmTitle' => $booking->getShowing() && $booking->getShowing()->getFilm()
                ? $booking->getShowing()->getFilm()->getTitle()
                : null,
            'seatId' => $booking->getSeat() ? $booking->getSeat()->getSeatId() : null,
            'seatNumber' => $booking->getSeat() ? $booking->getSeat()->getSeatNumber() : null,
            'theaterName' => $booking->getSeat() && $booking->getSeat()->getTheater()
                ? $booking->getSeat()->getTheater()->getName()
                : null
        ];
    }

    public static function mapCinemaToArray(CbCinema $cinema): array
    {
        return [
            'cinemaId' => $cinema->getCinemaId(),
            'name' => $cinema->getName(),
            'location' => $cinema->getLocation()
        ];
    }

    public static function mapFilmToArray(CbFilms $film): array
    {
        return [
            'filmId' => $film->getFilmId(),
            'title' => $film->getTitle(),
            'genre' => $film->getGenre(),
            'durationMinutes' => $film->getDurationMinutes(),
            'description' => $film->getDescription()
        ];
    }

    public static function mapSeatToArray(CbSeats $seat): array
    {
        return [
            'seatId' => $seat->getSeatId(),
            'seatNumber' => $seat->getSeatNumber(),
            'rowLabel' => $seat->getRowLabel(),
            'theaterId' => $seat->getTheater() ? $seat->getTheater()->getTheaterId() : null,
            'theaterName' => $seat->getTheater() ? $seat->getTheater()->getName() : null
        ];
    }

    public static function mapShowingToArray(CbShowings $showing): array
    {
        $film = $showing->getFilm(); // <--- corrected here

        return [
            'showingId' => $showing->getShowingId(),
            'showTime' => $showing->getShowTime()->format('Y-m-d H:i:s'),
            'theaterId' => $showing->getTheater() ? $showing->getTheater()->getTheaterId() : null,
            'theaterName' => $showing->getTheater() ? $showing->getTheater()->getName() : null,
            'filmId' => $film ? $film->getFilmId() : null,
            'filmTitle' => $film ? $film->getTitle() : null,
            'filmGenre' => $film ? $film->getGenre() : null,
            'durationMinutes' => $film ? $film->getDurationMinutes() : null
        ];
    }

    public static function mapTheaterToArray(CbTheater $theater): array
    {
        return [
            'theaterId' => $theater->getTheaterId(),
            'name' => $theater->getName(),
            'seatCount' => $theater->getSeatCount(),
            'cinemaId' => $theater->getCinema() ? $theater->getCinema()->getCinemaId() : null,
            'cinemaName' => $theater->getCinema() ? $theater->getCinema()->getName() : null,
            'cinemaLocation' => $theater->getCinema() ? $theater->getCinema()->getLocation() : null
        ];
    }

    public static function mapUserToArray(CbUsers $user): array
    {
        return [
            'userId' => $user->getUserId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'createdAt' => $user->getCreatedAt()->format('Y-m-d H:i:s')
        ];
    }

    public static function mapEntitiesToArrays(array $entities, string $entityType): array
    {
        return array_map(fn($entity) => self::mapEntityToArray($entity, $entityType), $entities);
    }

    public static function mapEntityToArray($entity, string $entityType): array
    {
        switch ($entityType) {
            case 'booking':
                return self::mapBookingToArray($entity);
            case 'cinema':
                return self::mapCinemaToArray($entity);
            case 'film':
                return self::mapFilmToArray($entity);
            case 'seat':
                return self::mapSeatToArray($entity);
            case 'showing':
                return self::mapShowingToArray($entity);
            case 'theater':
                return self::mapTheaterToArray($entity);
            case 'user':
                return self::mapUserToArray($entity);
            default:
                throw new \InvalidArgumentException("Unknown entity type: $entityType");
        }
    }
}
