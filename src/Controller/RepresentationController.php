<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Representation;

class RepresentationController extends AbstractController
{
    /**
     * @Route("/representation", name="representation_index")
     */
    public function index()
    {
        $title = "Representations";
        $repository = $this->getDoctrine()->getRepository(Representation::class);
        $representations = $repository->findAll();
        
        return $this->render('representation/index.html.twig', [
            'title' => $title,
            'representations'=>$representations
        ]);
    }
    
    /**
     * @Route("/representation/{id}", name="representation_show")
     */
    public function show(Representation $representation)
    {
        $title = "Representation";
        return $this->render('representation/show.html.twig', [
            'title' => $title,
            'representation'=>$representation
        ]);
    }
}
