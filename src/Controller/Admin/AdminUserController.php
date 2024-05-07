<?php

namespace App\Controller\Admin;

use App\Entity\AdminUser;
use App\Form\AdminUserType;
use App\Repository\AdminUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'app_admin_user_')]
class AdminUserController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/utilisateurs', name: 'index')]
    public function index(AdminUserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/utilisateurs/edit/{id}', name: 'edit', methods: ['POST', 'GET'])]
    public function edit(AdminUser $user, Request $request): Response
    {
        $form = $this->createForm(AdminUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'Utilisateur édité avec succès');
            return $this->redirectToRoute('app_admin_user_edit', ['id' => $user->getId()]);
        }

        return $this->render('admin/user/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/utilisateurs/delete/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(AdminUser $user): Response
    {
        $this->em->remove($user);
        $this->em->flush();
        $this->addFlash('danger', 'Utilisateur supprimé avec succès');
        return $this->redirectToRoute('app_admin_user_index');
    }
}
