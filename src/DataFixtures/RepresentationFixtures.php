<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Representation;

class RepresentationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $representations = [
            [
                'the_location'=>'dexia-art-center',
                'the_show'=>'ayiti',
                'schedule'=>'2012-10-12 13:30',
            ],
            [
                'the_location'=>'dexia-art-center',
                'the_show'=>'ayiti',
                'schedule'=>'2012-10-12 20:30',
            ],
            [
                'the_location'=>null,
                'the_show'=>'ayiti',
                'schedule'=>'2012-10-02 20:30',
            ],
            [
                'the_location'=>null,
                'the_show'=>'ayiti',
                'schedule'=>'2012-10-16 20:30',
            ],
        ];
        
        foreach ($representations as $record) {           
            $representation = new Representation();
            
            if($record['the_location']) {
                $representation->setTheLocation($this->getReference($record['the_location']));
            }
            
            $representation->setTheShow($this->getReference($record['the_show']));
            $representation->setSchedule(new \DateTime($record['schedule']));
                        
            $manager->persist($representation);
        }

        $manager->flush();
    }

    public function getDependencies() {
        return [
            LocationFixtures::class,
            ShowFixtures::class,
        ];
    }
}