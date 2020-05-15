<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;

class LocationController extends AbstractController
{
    /**
     * @Route("/location", name="location")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Location::class);
        $locations = $repository->findAll();

        return $this->render('location/index.html.twig', [
            'locations' => $locations,
            'resource' => 'lieux',
        ]);
    }
    
    /**
     * @Route("/location/{id}", name="location_show")
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