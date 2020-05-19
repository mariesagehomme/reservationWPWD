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
             [
                'slug'=>null,
                'title'=>'Cible mouvante',
                'description'=>'Dans ce « thriller d’anticipation », des adultes semblent alimenter '
                    . 'et véhiculer une crainte féroce envers les enfants âgés entre 10 et 12 ans.',
                'poster_url'=>'cible.jpg',
                'location_slug'=>'dexia-art-center',
                'bookable'=>true,
                'price'=>9.00,
            ],
            [
                'slug'=>null,
                'title'=>'Ceci n\'est pas un chanteur belge',
                'description'=>"Non peut-être ?!\nEntre Magritte (pour le surréalisme comique) "
                    . 'et Maigret (pour le réalisme mélancolique), ce dixième opus semalien propose '
                    . 'quatorze nouvelles chansons mêlées à de petits textes humoristiques et '
                    . 'à quelques fortes images poétiques.',
                'poster_url'=>'cible.jpg',
                'location_slug'=>null,
                'bookable'=>false,
                'price'=>5.50,
            ],
            [
                'slug'=>null,
                'title'=>'Manneke… !',
                'description'=>'A tour de rôle, Pierre se joue de ses oncles, '
                    . 'tantes, grands-parents et surtout de sa mère.',
                'poster_url'=>'cible.jpg',
                'location_slug'=>'la-samaritaine',
                'bookable'=>true,
                'price'=>10.50,
            ],
            [
                'slug'=>null,
                'title'=>'LE DIABLE EST UNE GENTILLE PETITE FILLE',
                'description'=>"Dans un humour noir décapant et une irrévérence totale, la folie angélique de Laura Laune et de ses personnages emplis de paradoxes vous donne des frissons : est-elle innocente ou méchante ? Consciente de ses propos où simplement folle à lier ? D’une comptine pour enfants qui part en vrille, à des personnages d’une folie d’apparence imperceptible, le spectacle vous réserve bien des surprises.",
                'poster_url'=>'laura-laune-site.jpg',
                'location_slug'=>null,
                'bookable'=>false,
                'price'=>35.00,
            ],
            [
                'slug'=>null,
                'title'=>'NOUVEAU SPECTACLE EN RODAGE',
                'description'=>"À chacun de ses trois enfants Olivier de Benoist s’est engagé à faire un one man show : Très Très Haut débit, Fournisseur d’excès et 0/40. Olivier de Benoist étant tout juste père pour la quatrième fois, il respecte donc sa parole en proposant un nouveau spectacle qu’il a appelé naturellement Le Petit Dernier! ",
                'poster_url'=>'olivier-debenoist.png',
                'location_slug'=>'la-samaritaine',
                'bookable'=>true,
                'price'=>22.50,
            ],
                        [
                'slug'=>null,
                'title'=>'THE ONE MOTHER SHOW',
                'description'=>"4 enfants et 1 Bertrand qui croit toujours bien faire. Des chaussettes qui traînent, des leçons à faire réciter, un rôle de Maman-taxi, des week-ends sans temps mort, des nuits blanches et des matins tête de travers. Voilà le quotidien d’une maman … comme les autres ! Véronique Gallo profite de son « One Mother Show » pour dire tout haut ce que toutes les mères pensent tout bas.",
                'poster_url'=>'vronique-gallo.jpg',
                'location_slug'=>null,
                'bookable'=>false,
                'price'=>25.00,
            ],
            [
                'slug'=>null,
                'title'=>'QUI VOULAIT FAIRE SON SPECTACLE',
                'description'=>"Le loup qui voulait faire son spectacle",
                'poster_url'=>'LELOUP.jpg',
                'location_slug'=>'la-samaritaine',
                'bookable'=>true,
                'price'=>22.50,
            ],
            [
                'slug'=>null,
                'title'=>'21ÈME SECONDE',
                'description'=>"Avant de prouver que je suis quelqu’un de bien, je dois d’abord prouver que je ne suis pas quelqu’un de pas bien. Quand tu rencontres quelqu’un pour la première fois, inconsciemment, en 20 secondes la personne se fait un avis sur toi et décide si tu es quelqu’un de bien ou pas."
                ."Moi j’ai une étape en plus. Avant de prouver que je suis quelqu’un de bien, je dois d’abord prouver que je ne suis pas quelqu’un de pas bien."
                ."20 secondes c’est pas beaucoup … J’ai rien à voir avec tout ça moi d’accord !",
                'poster_url'=>'jason-brokerss.jpg',
                'location_slug'=>'dexia-art-center',
                'bookable'=>true,
                'price'=>18.50,
            ],
            [
                'slug'=>null,
                'title'=>'DÉMASQUÉ',
                'description'=>"Un an après avoir rempli Forest National avec son premier spectacle « Entre nous », "
                . "Pablo Andres revient sur scène avec un tout nouveau spectacle, Pablo Andres : Démasqué !",
                'poster_url'=>'pablo-andres-demasque.jpg',
                'location_slug'=>'dexia-art-center',
                'bookable'=>true,
                'price'=>35.50,
            ],
            [
                'slug'=>null,
                'title'=>'"TITRE PROVISOIRE"',
                'description'=>"Pour mon nouveau spectacle, retraçant les 4 dernières années de ma vie et qui pourrait se résumer à la question « comment faire rire quand on tombe lentement dans la dépression ? » on m’a demandé de faire un pitch :"
                ."Arnaud Tsamere + 1 épouse = 1 mariage – 1 épouse = 1 divorce + 1 autre épouse = 2 mariages + 1 enfant + le départ de la nouvelle épouse = 2 divorces + une garde alternée + la mort du père – la motivation = 4 ans de dépression + la renaissance + 1 œuf au plat = le spectacle de la maturation."
                ."Après 3 one man show et près de 400 000 spectateurs dans toute la France, Arnaud Tsamere revient en 2020 avec un nouveau spectacle.",
                'poster_url'=>'arnaud-tsamere.jpg',
                'location_slug'=>'la-samaritaine',
                'bookable'=>true,
                'price'=>22.50,
            ],
            [
                'slug'=>null,
                'title'=>"N'ÉCOUTEZ PAS MESDAMES",
                'description'=>"Une comédie de Sacha Guitry | Avec Michel Sardou et 8 comédiens"
                ."Michel Sardou dans N’écoutez pas, Mesdames, une comédie spirituelle de Sacha Guitry sur l’art d’aimer ! Daniel découvre que sa femme n’est pas rentrée de la nuit pour la seconde fois… Dès lors qu’il soupçonne son épouse d’entretenir une liaison avec un autre homme, il envisage le divorce et, finalement, la prie de s’en aller. Aussitôt Valentine, sa première épouse accourt pour le reconquérir….",
                'poster_url'=>'michel-sardou.jpg',
                'location_slug'=>'dexia-art-center',
                'bookable'=>false,
                'price'=>22.50,
            ],            
            
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