<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $users = [
            [
                'login'=>'bob',
                'password'=>'epfc',
                'firstname'=>'Bob',
                'lastname'=>'Sull',
                'email'=>'bob@sull.com',
                'langue'=>'fr',
                'picture'=>'bob.jpg',
            ],
            [
                'login'=>'fred',
                'password'=>'epfc',
                'firstname'=>'Fred',
                'lastname'=>'Astair',
                'email'=>'fred@sull.com',
                'langue'=>'en',
                'picture'=>'fred.jpg',
            ],
            [
                'login'=>'judith',
                'password'=>'epfc',
                'firstname'=>'Judith',
                'lastname'=>'Larson',
                'email'=>'jud@lars.com',
                'langue'=>'fr',
                'picture'=>'judith.jpg',
            ],
        ];
        
        foreach ($users as $record) {
            $user = new User();
           /* $encoder = new UserPasswordEncoder($factory);
            $password = $encoder->encode($user, $record['password']);
           */ 
            $user->setLogin($record['login']);
            $user->setPassword($record['password']);
            $user->setFirstname($record['firstname']);
            $user->setLastname($record['lastname']);
            $user->setEmail($record['email']);
            $user->setLangue($record['langue']);
            $user->setPicture($record['picture']);
            
            $this->addReference($record['login'],$user);
            
            $manager->persist($user);
        }

        $manager->flush();
    }
}