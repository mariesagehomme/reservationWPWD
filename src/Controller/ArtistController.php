<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artist;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ArtistController extends AbstractController
{
    /**
     * @Route("/artist", name="artist_index")
     * @Security("is_granted('ROLE_ADMIN', 'ROLE_MEMBER', 'ROLE_AFFILIATE')")
     */
    public function index()
    {
        $titre = 'Artists';
        
        $repository = $this->getDoctrine()->getRepository(Artist::class);
        $artists = $repository->findAll();
        
        return $this->render('artist/index.html.twig', [
            'titre' => $titre,
            'artists' => $artists,
        ]);
    }
    
    
    /**
     * @Route("/artist/{id}", name="artist_show")
     * @Security("is_granted('ROLE_ADMIN', 'ROLE_MEMBER', 'ROLE_AFFILIATE')")
     */
    public function show(Artist $artist)
    {
        $titre = 'Artist';
        
//        $repository = $this->getDoctrine()->getRepository(Artist::class);
//        $artist = $repository->find($id);
        
        return $this->render('artist/show.html.twig', [
            'titre'=>$titre,
            'artist'=>$artist,
        ]);
    }
}
