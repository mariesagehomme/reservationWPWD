<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Role;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class RoleController extends AbstractController
{
    /**
     * @Route("/role", name="role_index")
     * @Security("is_granted('ROLE_ADMIN')")
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
      * @Security("is_granted('ROLE_ADMIN')")
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
