<?php

namespace App\Controller;

use App\Entity\Reservation;
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
     * @Security("is_granted('ROLE_ADMIN', 'ROLE_MEMBER', 'ROLE_AFFILIATE')")
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
     * @Security("is_granted('ROLE_ADMIN', 'ROLE_MEMBER', 'ROLE_AFFILIATE')")
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
     * @Security("is_granted('ROLE_ADMIN', 'ROLE_MEMBER', 'ROLE_AFFILIATE')")
     */
    public function pay(Request $request, Reservation $reservation): Response  {

       //var_dump($request->request); die;
      
        \Stripe\Stripe::setApiKey('sk_test_a84m1hrSViHaGM7UJTkJR0ok00iz91QCPu');
        \Stripe\PaymentIntent::create([
          'amount' => 2000,
          'currency' => 'eur',
          'payment_method_types' => ['card'],
        ]);

       return $this->render('reservation/pay.html.twig', [
            'reservation' => $reservation
        ]);
    }
    
}