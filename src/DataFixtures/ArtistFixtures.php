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
            ['firstname'=>'Bob','lastname'=>'Sull', 'agent'=>'boby@agent.com'],
            ['firstname'=>'Marc','lastname'=>'Flynn', 'agent'=>'fredy@agent.com'],
            ['firstname'=>'Fred','lastname'=>'Durand', 'agent'=>'juddy@agent.com'],
        ];
        
        foreach ($artists as $record) {
            $artist = new Artist();
            $artist->setFirstname($record['firstname']);
            $artist->setLastname($record['lastname']);
            $artist->setAgent($this->getReference($record['agent']));
            $manager->persist($artist);
            
            $this->addReference(
                    $record['firstname']."-".$record['lastname'],
                    $artist
            );
        }

        $manager->flush();
    }
}
