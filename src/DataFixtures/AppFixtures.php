<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
        
    }


    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setRoles(["ROLE_ADMIN"])
        ->setEmail("admin@test.com")
        ->setPassword($this->hasher->hashPassword($user, 'admin'));
        $manager->persist($user);

        $manager->flush();
    }
}
