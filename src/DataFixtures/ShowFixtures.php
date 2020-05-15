<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Show;
use Cocur\Slugify\Slugify;

class ShowFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $shows = [
            [
                'slug'=>null,
                'title'=>'Ayiti',
                'description'=>"Un homme est bloqué à l’aéroport.\n "
                    . 'Questionné par les douaniers, il doit alors justifier son identité, '
                    . 'et surtout prouver qu\'il est haïtien – qu\'est-ce qu\'être haïtien ?',
                'poster_url'=>'ayiti.jpg',
                'location_slug'=>'dexia-art-center',
                'bookable'=>true,
                'price'=>8.50,
            ],
//…
        ];
        
        foreach ($shows as $record) {
            $slugify = new Slugify();
            
            $show = new Show();
            $show->setSlug($slugify->slugify($record['title']));
            $show->setTitle($record['title']);
            $show->setDescription($record['description']);
            $show->setPosterUrl($record['poster_url']);
            
            if($record['location_slug']) {
                $show->setLocation($this->getReference($record['location_slug']));
            }
            
            $show->setBookable($record['bookable']);
            $show->setPrice($record['price']);
            
            $this->addReference($show->getSlug(), $show);
            
            $manager->persist($show);
        }

        $manager->flush();
    }

    public function getDependencies() {
        return [
            LocationFixtures::class,
        ];
    }

}