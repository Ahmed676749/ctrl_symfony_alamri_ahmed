<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Faker\Factory as Faker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');
        $password = $this->userPasswordHasher->hashPassword(new User(), 'password');

        for ($i=0; $i < 20; $i++) {
        $user = new User();
        $user->setEmail($faker->email())
             ->setNickname($faker->userName())
             ->setRoles(['ROLE_USER'])
             ->setPassword($password)
             ->setCreatedAt(new DateTimeImmutable())
             ->setUpdatedAt(new DateTimeImmutable())
        ;
        $manager->persist($user);
        }
        $manager->flush();
    }
}
