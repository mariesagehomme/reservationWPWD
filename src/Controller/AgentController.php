<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Agent;
use App\Entity\Artist;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\TransferType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter; 

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AgentController extends AbstractController
{
    /**
     * @Route("/agent", name="agent_index")
     * @Security("is_granted('ROLE_ADMIN', 'ROLE_MEMBER', 'ROLE_AFFILIATE')")
     */
    public function index()
    {
        
        $repository = $this->getDoctrine()->getRepository(Agent::class);
        $agents = $repository->findAll();
        
        return $this->render('agent/index.html.twig', [
            'agents' => $agents,
        ]);

    }

    
   /**
     * @Route("/agent/{id}/transfer/{artist_id}", name="agent_transfer", methods={"GET","POST"})
     * @ParamConverter("artist", options={"id" = "artist_id"})   
     */
    public function transfer(Agent $agent, Artist $artist, Request $request): Response
        {

            $form = $this->createForm(TransferType::class,$artist);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
               //Persister les modifications de l'artiste
               $this->getDoctrine()->getManager()->flush();

               //Redirection vers la fiche de l'artiste
               return $this->redirectToRoute('artist_show',['id'=>$artist->getId()]);
            }

            return $this->render('agent/transfer.html.twig', [
                'artist' => $artist,
                'formTransfer' => $form->createView(),
            ]);
        }
}
