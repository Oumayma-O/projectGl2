<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Voiture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create('fr_FR');
        for($i=0;$i<50;$i++){
            $voiture= new \App\Entity\Voiture();
            $voiture->setMarque($faker->city);
            $voiture->setOwnerName($faker->name);
            $manager->persist($voiture);
        }
        $manager->flush();
    }
}
