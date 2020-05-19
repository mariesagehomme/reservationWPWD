<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Role;

class RoleController extends AbstractController
{
    /**
     * @Route("/role", name="role_index")
     */
    public function index()
    {
        $titre = 'Roles';
        
        $repository = $this->getDoctrine()->getRepository(Role::class);
        $roles = $repository->findAll();
        
        return $this->render('role/index.html.twig', [
            'title' => $titre,
            'roles' => $roles,
        ]);
    }
    
     /**
     * @Route("/role/{id}", name="role_show")
     */
    public function show(Role $role)
    {
        $titre = 'Role';
        
        //$repository = $this->getDoctrine()->getRepository(Role::class);
        //$role = $repository->find($id);
        
        return $this->render('role/show.html.twig', [
            'title'=>$titre,
            'role'=>$role,
        ]);
    }
}
