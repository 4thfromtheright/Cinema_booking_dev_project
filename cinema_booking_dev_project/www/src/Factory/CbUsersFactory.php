<?php

namespace App\Factory;

use App\Entity\CbUsers;
use Doctrine\ORM\EntityManagerInterface;

class CbUsersFactory implements FactoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(array $data)
    {
        $entity = new CbUsers();

        foreach ($data as $key => $value) {
            // Convert snake_case to CamelCase for setter
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
            if (method_exists($entity, $method)) {
                $entity->$method($value !== '' ? $value : null);
            }
        }

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }


    public function getById($id)
    {
        return $this->em->getRepository(CbUsers::class)->find($id);
    }

    public function getBy(array $criteria)
    {
        return $this->em->getRepository(CbUsers::class)->findBy($criteria);
    }

    public function update($entity, array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($entity, $method)) {
                $entity->$method($value !== '' ? $value : null);
            }
        }
        $this->em->flush();
        return $entity;
    }

    public function delete($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }

    public function findAll()
    {
        return $this->em->getRepository(CbUsers::class)->findAll();
    }
}
