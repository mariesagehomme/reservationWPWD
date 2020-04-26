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
        
        foreach ($types as $data) {
            $type = new Type();
            $type->setType($data['type']);
            
            $manager->persist($type);
        }

        $manager->flush();
    }
}
