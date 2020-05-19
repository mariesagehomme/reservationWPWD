<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Locality;
use App\Form\LocalityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalityController extends AbstractController
{
    /**
     * @Route("/locality", name="locality_index")
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
     * @Route("/locality/{id}", name="locality_show", requirements={"id"="\d+"})
     */
     public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Locality::class);
        $locality = $repository->find($id);

        return $this->render('locality/show.html.twig', [
            'locality' => $locality,
        ]);
    }
    
     /**
     * @Route("/locality/{id}/edit", name="locality_edit", methods={"GET","POST"})
     */
     public function edit(Request $request, Locality $locality): Response
    {
        $form = $this->createForm(LocalityType::class, $locality);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('locality_index');
        } 
        
        return $this->render('locality/edit.html.twig', [
            'locality' => $locality,
            'form' => $form->createView()
        ]);
        
    }
}
