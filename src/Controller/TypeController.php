<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Type;

class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="type_index")
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
