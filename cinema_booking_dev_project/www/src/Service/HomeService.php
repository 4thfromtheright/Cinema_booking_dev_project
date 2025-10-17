<?php
namespace App\Service;

use App\Service\FactoryServiceProviderInterface;

class HomeService implements HomeServiceInterface
{
    private $factoryProvider;

    public function __construct(FactoryServiceProviderInterface $factoryProvider)
    {
        $this->factoryProvider = $factoryProvider;
    }

    public function listCinemas(): array
    {
        $cinemaFactory = $this->factoryProvider->getCinemaFactory();
        $cinemas = $cinemaFactory->findAll();

        $result = [];
        foreach ($cinemas as $cinema) {
            $result[] = [
                'id' => $cinema->getCinemaId(),
                'name' => $cinema->getName(),
                'location' => $cinema->getLocation(),
            ];
        }

        return $result;
    }
}
