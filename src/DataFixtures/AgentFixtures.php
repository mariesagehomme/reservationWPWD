<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Agent;

class AgentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       $agents = [
            ['name'=>'Boby','email'=>'boby@agent.com'],
            ['name'=>'fredy','email'=>'fredy@agent.com'],
            ['name'=>'Juddy','email'=>'juddy@agent.com']
        ];
        
        foreach ($agents as $record) {
            $agent = new Agent();
            $agent->setName($record['name']);
            $agent->setEmail($record['email']);
            $manager->persist($agent);
            
            $this->addReference(
                    $record['email'],
                    $agent
            );
        }

        $manager->flush();
    }
}
