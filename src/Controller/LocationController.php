<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class LocationController extends AbstractController
{
    /**
     * @Route("/location", name="location_index")
     * @IsGranted("ROLE_MEMBER")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Location::class);
        $locations = $repository->findAll();

        return $this->render('location/index.html.twig', [
            'locations' => $locations,
            'resource' => 'Locations',
        ]);
    }
    
    /**
     * @Route("/location/{id}", name="location_show")
     * @IsGranted("ROLE_MEMBER")
     */
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Location::class);
        $location = $repository->find($id);

        return $this->render('location/show.html.twig', [
            'location' => $location,
        ]);
    }

}