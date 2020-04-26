<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Locality;

class LocalityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
{
        $localities = [
            [
            'postal_code'=>'1000',
            'locality'=>'Bruxelles'
            ],
            [
            'postal_code'=>'1030',
            'locality'=>'Scharbeek'
            ],
            [
            'postal_code'=>'1170',
            'locality'=>'Watermael-Boitsfort'
            ],
        ];
        
        foreach ($localities as $data) {
            $localities = new Locality();
            $localities->setPostalCode($data['postal_code']);
            $localities->setLocality($data['locality']);
            
            $manager->persist($localities);
        }

        $manager->flush();
    }
}
