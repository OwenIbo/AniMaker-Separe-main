<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\StudioDanimation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
;

class StudioAnimation extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create('fr_FR');
        for($i=1;$i<=10;$i++)
        {
            $studio=new StudioDanimation();
            $studio->setNomStudio($faker->words(2, true));
            $manager->persist($studio);
        }
        $manager->flush();
    }
}
