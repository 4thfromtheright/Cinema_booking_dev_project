<?php
// src/Services/UserService.php
namespace App\Service;

use App\Entity\CbUsers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService implements UserServiceInterface
{
    private $factoryProvider;
    private $passwordEncoder;
    private $em;

    public function __construct(
        FactoryServiceProviderInterface $factoryProvider,
        UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $em
    ) {
        $this->factoryProvider = $factoryProvider;
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }

    public function signup(array $data): CbUsers
    {
        $userFactory = $this->factoryProvider->getUserFactory();

        $data['password_hash'] = $this->passwordEncoder->encodePassword(
            new CbUsers(),
            $data['password'] ?? ''
        );

        return $userFactory->create([
            'email' => $data['email'] ?? null,
            'name' => $data['name'] ?? null,
            'passwordHash' => $data['password_hash'],
        ]);
    }

    public function getUserByEmail(string $email): ?CbUsers
    {
        $userFactory = $this->factoryProvider->getUserFactory();
        return $userFactory->findOneBy(['email' => $email]);
    }
}
