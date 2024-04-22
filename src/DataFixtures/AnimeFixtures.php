<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Anime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;;

class AnimeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $anime = new Anime();
            $anime->setNom($faker->name())
                ->setDescription($faker->paragraph(1))
                ->setAuteur($faker->name())
                ->setNbEpisode(10)
                ->setNbSaison(2)
                ->setDureeEp("2000")
                ->setVideoURL("https/urlvideo")
                ->setType("Horror");
            $manager->persist($anime);
        }

        $manager->flush();
    }
}
