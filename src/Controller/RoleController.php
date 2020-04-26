<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Role;

class RoleController extends AbstractController
{
    /**
     * @Route("/role", name="role")
     */
    public function index()
    {
        $titre = 'Liste des Roles';
        
        $repository = $this->getDoctrine()->getRepository(Role::class);
        $roles = $repository->findAll();
        
        return $this->render('role/index.html.twig', [
            'titre' => $titre,
            'roles' => $roles,
        ]);
    }
    
     /**
     * @Route("/role/{id}", name="role_show")
     */
    public function show($role)
    {
        $titre = 'Fiche role';
        
        $repository = $this->getDoctrine()->getRepository(Role::class);
        $role = $repository->find($id);
        
        return $this->render('role/show.html.twig', [
            'titre'=>$titre,
            'role'=>$role,
        ]);
    }
}
