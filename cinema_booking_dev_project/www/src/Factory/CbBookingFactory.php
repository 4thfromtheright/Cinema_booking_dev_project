<?php

namespace App\Factory;

use App\Entity\CbBooking;
use Doctrine\ORM\EntityManagerInterface;

class CbBookingFactory implements FactoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(array $data)
    {
        $booking = new CbBooking();

        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($booking, $method)) {
                $booking->$method($value !== '' ? $value : null);
            }
        }

        $this->em->persist($booking);
        $this->em->flush();

        return $booking;
    }

    public function getById($id)
    {
        return $this->em->getRepository(CbBooking::class)->find($id);
    }

    public function getBy(array $criteria)
    {
        return $this->em->getRepository(CbBooking::class)->findBy($criteria);
    }

    public function update(CbBooking $booking, array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($booking, $method)) {
                $booking->$method($value !== '' ? $value : null);
            }
        }

        $this->em->flush();
        return $booking;
    }

    public function delete(CbBooking $booking)
    {
        $this->em->remove($booking);
        $this->em->flush();
    }
}
