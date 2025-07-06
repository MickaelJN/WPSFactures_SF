<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Company;
use App\Entity\Customer;
use App\Entity\Individual;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher) {}


    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setRoles(["ROLE_ADMIN"])
            ->setEmail("admin@test.com")
            ->setPassword($this->hasher->hashPassword($user, 'admin'));
        $manager->persist($user);

        $manager->flush();


        $customer = new Individual();
        $customer->setLastname('Martos')
            ->setFirstname('Patricia')
            ->setAddress("rue de Gravelone 74")
            ->setZipCode("1950")
            ->setCity("Sion")
            ->setPhone("0781234567")
            ->setEmail("patricia.martos@gmail.com")
        ;
        $manager->persist($customer);

        $customer2 = new Company();
        $customer2->setCompanyName('Super Entreprise')
            ->setAddress("34 rue Gambetta")
            ->setZipCode("71000")
            ->setCity("Mâcon")
            ->setPhone("0668216842")
            ->setEmail("super.entreprise@test.com")
        ;
        $manager->persist($customer2);

        $manager->flush();
    }
}
