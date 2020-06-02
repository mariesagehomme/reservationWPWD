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
            ['role'=>'ROLE_ADMIN'],
            ['role'=>'ROLE_MEMBER'],
            ['role'=>'ROLE_AFFILIATE'],
        ];
        
        foreach($roles as $data) {
            $role = new Role();
            $role->setRole($data['role']);
            
            $this->addReference($data['role'],$role);
            
            $manager->persist($role);
        }

        $manager->flush();
    }
}