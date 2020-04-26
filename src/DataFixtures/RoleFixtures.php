<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Role;

class RoleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
        {
        $roles = [
            ['role'=>'admin'],
            ['role'=>'member'],
            ['role'=>'affiliate'],
        ];
        
        foreach ($roles as $data) {
            $roles = new Role();
            $roles->setRole($data['role']);
            
            $manager->persist($roles);
        }

        $manager->flush();
    }
}
