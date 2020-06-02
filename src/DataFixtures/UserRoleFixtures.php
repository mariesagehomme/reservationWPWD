<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserRoleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userRoles = [
            [
                'user_login'=>'bob',
                'role'=>'ROLE_ADMIN',
            ],
            [
                'user_login'=>'fred',
                'role'=>'ROLE_MEMBER',
            ],
            [
                'user_login'=>'judith',
                'role'=>'ROLE_AFFILIATE',
            ],
        ];
        
        foreach($userRoles as $record) {
            $user = $this->getReference($record['user_login']);
            $role = $this->getReference($record['role']);
            
            $user->addRole($role);
                    
            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies() {
        return [
            UserFixtures::class,  
            RoleFixtures::class,  
        ];
    }

}