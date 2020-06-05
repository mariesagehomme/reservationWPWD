<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Agent;

class AgentController extends AbstractController
{
    /**
     * @Route("/agent", name="agent")
     */
    public function index()
    {
        {
        
        $repository = $this->getDoctrine()->getRepository(Agent::class);
        $agents = $repository->findAll();
        
        return $this->render('agent/index.html.twig', [
            'agents' => $agents,
        ]);
    }

    }
}
