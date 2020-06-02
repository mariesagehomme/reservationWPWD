<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Representation;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class RepresentationController extends AbstractController
{
    /**
     * @Route("/representation", name="representation_index")
     * @Security("is_granted('ROLE_ADMIN', 'ROLE_MEMBER', 'ROLE_AFFILIATE')")
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
     * @Security("is_granted('ROLE_ADMIN', 'ROLE_MEMBER', 'ROLE_AFFILIATE')")
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
