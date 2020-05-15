<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Type;

class TypeFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $types = [
            ['type'=>'comédien'],
            ['type'=>'scénographe'],
            ['type'=>'auteur'],
        ];
        
        foreach ($types as $record) {
            $type = new Type();
            $type->setType($record['type']);
            
            $manager->persist($type);
            
            $this->addReference($record['type'],$type);
        }

        $manager->flush();
    }
}
