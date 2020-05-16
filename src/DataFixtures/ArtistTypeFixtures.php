<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\ArtistType;

class ArtistTypeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $artistTypes = [
            [
                'artist_firstname'=>'Bob',
                'artist_lastname'=>'Sull',
                'type'=>'comédien',
            ],
            [
                'artist_firstname'=>'Bob',
                'artist_lastname'=>'Sull',
                'type'=>'auteur',
            ],
            [
                'artist_firstname'=>'Bob',
                'artist_lastname'=>'Sull',
                'type'=>'scénographe',
            ],
            [
                'artist_firstname'=>'Marc',
                'artist_lastname'=>'Flynn',
                'type'=>'scénographe',
            ],
            [
                'artist_firstname'=>'Marc',
                'artist_lastname'=>'Flynn',
                'type'=>'comédien',
            ],
            [
                'artist_firstname'=>'Marc',
                'artist_lastname'=>'Flynn',
                'type'=>'auteur',
            ],
            [
                'artist_firstname'=>'Fred',
                'artist_lastname'=>'Durand',
                'type'=>'scénographe',
            ],
            [
                'artist_firstname'=>'Fred',
                'artist_lastname'=>'Durand',
                'type'=>'comédien',
            ],
            [
                'artist_firstname'=>'Fred',
                'artist_lastname'=>'Durand',
                'type'=>'auteur',
            ],
         
        ];
        
       foreach($artistTypes as $record) {
            $artist = $this->getReference($record['artist_firstname'].'-'.$record['artist_lastname']);
            $type = $this->getReference($record['type']);
            
            $artistType = new ArtistType();
            $artistType->setArtist($artist);
            $artistType->setType($type);
            
            $this->addReference($record['artist_firstname']
                    .'-'.$record['artist_lastname']
                    .'-'.$record['type'],$artistType);
            
            $manager->persist($artistType); 
        }
        
        $manager->flush();
    }

    public function getDependencies() {
        return [
            ArtistFixtures::class,
            TypeFixtures::class,
        ];
    }

}