<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
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
     * @Route("/user/{id}", name="user_show")
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
