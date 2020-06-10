<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Representation;
use App\Entity\User;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation_index", methods={"GET"})
     * @IsGranted("ROLE_MEMBER")
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        $reservations = $reservationRepository->findAll();
        
        $groupedReservations = [];
        foreach($reservations as $res) {
            $groupedReservations[$res->getUser()->getId()][] = $res;
        }
        
        return $this->render('reservation/index.html.twig', [
            'reservations' => $groupedReservations,
        ]);
    }

    /**
     * @Route("/reservation/new", name="reservation_new", methods={"GET","POST"})
     * @IsGranted("ROLE_MEMBER")
     */
    public function new(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reservation/{id}", name="reservation_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/reservation/{id}/edit", name="reservation_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_MEMBER")
     */
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservation_delete", methods={"DELETE"})
     * @IsGranted("ROLE_MEMBER")
     */
    public function delete(Request $request, Reservation $reservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }
        
    /**
     * @Route("/reservation/{id}/pay", name="reservation_pay")
     * @IsGranted("ROLE_MEMBER")
     */
    public function pay(Request $request, Representation $representation): Response  {
    //https://www.codevate.com/blog/how-to-accept-payments-with-stripe-in-symfony-web-apps

       \Stripe\Stripe::setApiKey('sk_test_a84m1hrSViHaGM7UJTkJR0ok00iz91QCPu');
       
      //accéder à l'entité de l'user connecté
       $user = $this->getUser(); 
       
       //Accéder à l'élément du template
       $token = filter_input(INPUT_POST, 'stripeToken');
       
        $reservation = new Reservation();
        $reservation->setRepresentation($representation);
        $reservation->setUser($user);
        
        
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
       
       if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
   
            // Create a Customer:
            $customer = \Stripe\Customer::create([
                'email' => $user->getEmail(),
                'source' => $token,
            ]);

            // Charge the Customer instead of the card:
            $charge = \Stripe\Charge::create([
                'amount' => 1000,
                'currency' => 'eur',
                'customer'=>$customer->id,
             ]);
            //Enregistrer les infos
            $entityManager->persist($reservation);
            $entityManager->flush();
            
            return $this->redirectToRoute('reservation_index');
            
       }

            return $this->render('reservation/pay.html.twig', [
                 'reservation' => $reservation,
                 'form' => $form->createView(),
             ]);
        }
}