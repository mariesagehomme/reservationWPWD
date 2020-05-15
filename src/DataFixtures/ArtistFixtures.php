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
        
        foreach ($artists as $record) {
            $artist = new Artist();
            $artist->setFirstname($record['firstname']);
            $artist->setLastname($record['lastname']);
            $manager->persist($artist);
            
            $this->addReference(
                    $record['firstname']."-".$record['lastname'],
                    $artist
            );
        }

        $manager->flush();
    }
}
