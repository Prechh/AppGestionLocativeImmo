<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 30; $i++) {
            $property = new Property();
            $property->setTitle($this->faker->word())
                ->setAddress($this->faker->word())
                ->setBedrooms(mt_rand(1, 5))
                ->setCity($this->faker->word())
                ->setDescription($this->faker->word())
                ->setFloor(mt_rand(1, 5))
                ->setHeat(mt_rand(1, 3))
                ->setPostalCode(mt_rand(01000, 98000))
                ->setPrice(mt_rand(300, 15000))
                ->setRooms(mt_rand(2, 10))
                ->setSold(mt_rand(0, 1))
                ->setSurface(mt_rand(10, 400));

            $manager->persist($property);
        }


        $manager->flush();
    }
}
