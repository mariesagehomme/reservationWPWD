<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="type_index")
     * @IsGranted("ROLE_MEMBER") //https://symfony.com/doc/4.2/best_practices/security.html
     */
    public function index()
    {  
        $repository = $this->getDoctrine()->getRepository(Type::class);
        $types = $repository->findAll();
        $titre = 'Types';

        return $this->render('type/index.html.twig', [
            'title'=>$titre,
            'types'=>$types,
        ]);
    }
    
        /**
     * @Route("/type/{id}", name="type_show")
     * @IsGranted("ROLE_MEMBER")
     */
    public function show(Type $type)
    {
        $titre = 'Type';
        
        return $this->render('type/show.html.twig', [
            'type' => $type,
            'title' => $titre,
        ]);
    }
}
