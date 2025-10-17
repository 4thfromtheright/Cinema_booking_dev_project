<?php
namespace App\Service;


use App\Factory\FactoryInterface;

interface FactoryServiceProviderInterface
{
    public function getCinemaFactory(): FactoryInterface;
    public function getFilmFactory(): FactoryInterface;
    public function getTheaterFactory(): FactoryInterface;
    public function getShowingFactory(): FactoryInterface;
    public function getSeatFactory(): FactoryInterface;
    public function getUserFactory(): FactoryInterface;
    public function getBookingFactory(): FactoryInterface;
}

