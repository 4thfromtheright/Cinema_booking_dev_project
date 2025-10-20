<?php
namespace App\Repository;

use App\Entity\CbUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CbUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CbUsers::class);
    }

    public function save(CbUsers $user, bool $flush = true): void
    {
        $this->_em->persist($user);
        if ($flush) $this->_em->flush();
    }

    public function remove(CbUsers $user, bool $flush = true): void
    {
        $this->_em->remove($user);
        if ($flush) $this->_em->flush();
    }
}
