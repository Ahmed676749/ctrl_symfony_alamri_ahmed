<?php

namespace App\DataFixtures;

use App\Entity\Post;
use DateTimeImmutable;
use Faker\Factory as Faker;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Faker::create('fr_FR');

        for ($i=0; $i < 100; $i++) {
            $users = $this->userRepository->findAll();
            $userRandomKey = array_rand($users);
            $user = $users[$userRandomKey];
            $post = new Post();
            $post->setTitle($faker->realText(10))
                ->setImage($faker->userName())
                ->setAuthor($user)
                ->setCreatedAt(new DateTimeImmutable())
                ->setUpdatedAt(new DateTimeImmutable())
            ;
            $manager->persist($post);
        }

            $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
