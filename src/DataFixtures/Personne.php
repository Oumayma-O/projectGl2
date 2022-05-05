<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Personne extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for($i=0;$i<100;$i++){
            $personne =new \App\Entity\Personne();
            $personne->setFirstname($faker->firstName);
            $personne->setName($faker->name);
            $personne->setAge($faker->numberBetween(18,65));

            $manager->persist($personne);

        }
        $manager->flush();
    }
}
