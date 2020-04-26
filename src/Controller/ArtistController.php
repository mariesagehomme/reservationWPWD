<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artist;

class ArtistController extends AbstractController
{
    /**
     * @Route("/artist", name="artists")
     */
    public function index()
    {
        $titre = 'Liste des artistes';
        
        $repository = $this->getDoctrine()->getRepository(Artist::class);
        $artists = $repository->findAll();
        
        return $this->render('artist/index.html.twig', [
            'titre' => $titre,
            'artists' => $artists,
        ]);
    }
    
    
    /**
     * @Route("/artist/{id}", name="artist")
     */
    public function show(Artist $artist)
    {
        $titre = 'Fiche artiste';
        
//        $repository = $this->getDoctrine()->getRepository(Artist::class);
//        $artist = $repository->find($id);
        
        return $this->render('artist/show.html.twig', [
            'titre'=>$titre,
            'artist'=>$artist,
        ]);
    }
}
