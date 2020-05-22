<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Reservation;

class ReservationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $reservations = [
            [
                'representation' => 'dexia-art-center|ayiti|2012-10-12 13:30',
                'user' => 'bob',
                'places' => 3,
            ],
            [
                'representation' => 'dexia-art-center|ayiti|2012-10-12 20:30',
                'user' => 'bob',
                'places' => 1,
            ],
            [
                'representation' => '|cible-mouvante|2012-10-02 20:30',
                'user' => 'judith',
                'places' => 2,
            ],
        ];
        
        
        foreach($reservations as $record) {
            $res = new Reservation();
            
            $representation = $this->getReference($record['representation']);
            $user = $this->getReference($record['user']);
            
            $res->setRepresentation($representation);
            $res->setUser($user);
            $res->setPlaces($record['places']);
            
            $manager->persist($res);
        }

        $manager->flush();
    }
    
    public function getDependencies() {
        return [
            RepresentationFixtures::class,
            UserFixtures::class,
        ];
    }
}