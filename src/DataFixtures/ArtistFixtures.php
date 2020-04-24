<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Artist;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $artists = [
            ['firstname'=>'Bob','lastname'=>'Sull'],
            ['firstname'=>'Marc','lastname'=>'Flynn'],
            ['firstname'=>'Fred','lastname'=>'Durand'],
        ];
        
        foreach ($artists as $a) {
            $artist = new Artist();
            $artist->setFirstname($a['firstname']);
            $artist->setLastname($a['lastname']);
            $manager->persist($artist);
        }
        
        $manager->flush();
    }
}
