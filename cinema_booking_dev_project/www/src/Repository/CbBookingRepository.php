<?php
namespace App\Repository;

use App\Entity\CbBooking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CbBookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CbBooking::class);
    }

    public function save(CbBooking $booking, bool $flush = true): void
    {
        $this->_em->persist($booking);
        if ($flush) $this->_em->flush();
    }

    public function remove(CbBooking $booking, bool $flush = true): void
    {
        $this->_em->remove($booking);
        if ($flush) $this->_em->flush();
    }

    public function findByUserId(int $userId): array
    {
        return $this->createQueryBuilder('b')
            ->where('b.user = :user')
            ->setParameter('user', $userId)
            ->getQuery()
            ->getResult();
    }
}
