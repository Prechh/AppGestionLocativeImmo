<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Contact;
use App\Entity\Property;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // property
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

        // Users
        for ($i = 1; $i < 10; $i++) {
            $user = new User();
            $user->setName($this->faker->lastName())
                ->setFirstname($this->faker->firstName())
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');


            $manager->persist($user);
        }

        // Contact 
        for ($i = 0; $i < 5; $i++) {
            $contact = new Contact();
            $contact->setName($this->faker->lastName())
                ->setFirstname($this->faker->firstName())
                ->setEmail($this->faker->email())
                ->setSubject('Demande n°' . ($i + 1))
                ->setMessage($this->faker->text());


            $manager->persist($contact);
        }


        $manager->flush();
    }
}
