<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\String\Slugger\SluggerInterface;


class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_index")
     * @IsGranted("ROLE_MEMBER") 
     */
    public function index()
    {
        $titre = 'Users';
        
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();
        
        return $this->render('user/index.html.twig', [
            'title' => $titre,
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
     *@IsGranted("ROLE_MEMBER") 
     */
    public function show(User $user)
    {
        $titre = 'Useur';
        
//        $repository = $this->getDoctrine()->getRepository(User::class);
//        $user = $repository->find($id);
        
        return $this->render('user/show.html.twig', [
            'title'=>$titre,
            'user'=>$user,
        ]);
    }
    
    /**
     * @Route("/user/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
     public function edit(Request $request, User $user, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $pictureFile = $form->get('picture')->getData();

            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME); //getData

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();

               try {
                    $pictureFile->move(
                        $this->getParameter('picture_directory'),
                        $newFilename
                    );
                    $user->setPicture($newFilename);
                    
                } catch (FileException $e) { //object 
                    echo $e->getMessage();
                }  
            }
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush(); //save
                                    
            return $this->redirect($this->generateUrl('user_index'));
        }
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/user/{id}", name="user_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */

     public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
