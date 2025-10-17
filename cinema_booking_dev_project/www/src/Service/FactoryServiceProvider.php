<?php
namespace App\Service;

use App\Factory\CbCinemaFactory;
use App\Factory\CbFilmsFactory;
use App\Factory\CbTheaterFactory;
use App\Factory\CbShowingsFactory;
use App\Factory\CbSeatsFactory;
use App\Factory\CbUsersFactory;
use App\Factory\CbBookingFactory;
use App\Factory\FactoryInterface;

class FactoryServiceProvider implements FactoryServiceProviderInterface
{
    private $cinemaFactory;
    private $filmFactory;
    private $theaterFactory;
    private $showingFactory;
    private $seatFactory;
    private $userFactory;
    private $bookingFactory;


    // so here i actually use concrete classes, for use in all the other services
    public function __construct(
        CbCinemaFactory $cinemaFactory,
        CbFilmsFactory $filmFactory,
        CbTheaterFactory $theaterFactory,
        CbShowingsFactory $showingFactory,
        CbSeatsFactory $seatFactory,
        CbUsersFactory $userFactory,
        CbBookingFactory $bookingFactory
    ) {
        $this->cinemaFactory = $cinemaFactory;
        $this->filmFactory = $filmFactory;
        $this->theaterFactory = $theaterFactory;
        $this->showingFactory = $showingFactory;
        $this->seatFactory = $seatFactory;
        $this->userFactory = $userFactory;
        $this->bookingFactory = $bookingFactory;
    }

    public function getCinemaFactory(): FactoryInterface
    {
        return $this->cinemaFactory;
    }

    public function getFilmFactory(): FactoryInterface
    {
        return $this->filmFactory;
    }

    public function getTheaterFactory(): FactoryInterface
    {
        return $this->theaterFactory;
    }

    public function getShowingFactory(): FactoryInterface
    {
        return $this->showingFactory;
    }

    public function getSeatFactory(): FactoryInterface
    {
        return $this->seatFactory;
    }

    public function getUserFactory(): FactoryInterface
    {
        return $this->userFactory;
    }

    public function getBookingFactory(): FactoryInterface
    {
        return $this->bookingFactory;
    }
}
