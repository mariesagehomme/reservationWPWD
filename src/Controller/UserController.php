<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_index")
     */
    public function index()
    {
        $titre = 'Liste des utilisateurs';
        
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();
        
        return $this->render('user/index.html.twig', [
            'titre' => $titre,
            'users' => $users,
        ]);    
    }
    
    /**
     * @Route("/user/new", name="user_new", methods={"GET","POST"})
     */
     public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
          
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

        return $this->redirectToRoute('user_index');
    }

        return $this->render('user/new.html.twig', [
            'user'=>$user,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/user/{id}", name="user_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(User $user)
    {
        $titre = 'Fiche utilisateur';
        
//        $repository = $this->getDoctrine()->getRepository(User::class);
//        $user = $repository->find($id);
        
        return $this->render('user/show.html.twig', [
            'titre'=>$titre,
            'user'=>$user,
        ]);
    }
}
