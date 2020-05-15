<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArtistTypeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $artistTypes = [
            [
                'artist_firstname'=>'Bob',
                'artist_lastname'=>'Sull',
                'type'=>'auteur',
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
                'type'=>'comédien',
            ],
         
        ];
        
        foreach ($artistTypes as $record) {
            //Récupérer l'artiste (entité principale)
            $artist = $this->getReference(
                $record['artist_firstname'].'-'.$record['artist_lastname']
            );
            
            //Récupérer le type (entité secondaire)
            $type = $this->getReference($record['type']);
            
            //Définir son type
            $artist->addType($type);
            
            //Persister l'entité principale
            $manager->persist($artist);            
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