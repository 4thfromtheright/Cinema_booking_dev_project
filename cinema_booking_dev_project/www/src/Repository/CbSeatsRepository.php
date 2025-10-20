<?php
namespace App\Repository;

use App\Entity\CbSeats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CbSeatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CbSeats::class);
    }

    public function save(CbSeats $seat, bool $flush = true): void
    {
        $this->_em->persist($seat);
        if ($flush) $this->_em->flush();
    }

    public function remove(CbSeats $seat, bool $flush = true): void
    {
        $this->_em->remove($seat);
        if ($flush) $this->_em->flush();
    }
}
