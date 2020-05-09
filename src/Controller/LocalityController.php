<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Locality;

class LocalityController extends AbstractController
{
    /**
     * @Route("/locality", name="locality")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Locality::class);
        $localites = $repository->findAll();
        $titre = 'Liste des Localités';
        
        return $this->render('locality/index.html.twig', [
            'titre' => $titre,
            'localites' => $localites
        ]);
    }
    
     /**
     * @Route("/locality/{id}", name="locality_show")
     */
     public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Locality::class);
        $locality = $repository->find($id);

        return $this->render('locality/show.html.twig', [
            'locality' => $locality,
        ]);
    }
}
