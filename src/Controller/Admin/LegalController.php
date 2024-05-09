<?php

namespace App\Controller\Admin;

use App\Entity\Faq;
use App\Entity\Legal;
use App\Form\FaqType;
use App\Form\LegalType;
use App\Repository\FaqRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[\Symfony\Component\Routing\Annotation\Route('/admin/legal', name: 'app_admin_legal_')]
class LegalController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['POST', 'GET'])]
    public function editLegal(Legal $legal, Request $request): Response
    {
        $form = $this->createForm(LegalType::class, $legal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($legal);
            $this->em->flush();
            $this->addFlash('success', 'Mentions éditées avec succès');
            return $this->redirectToRoute('app_admin_legal_edit', ['id' => $legal->getId()]);
        }

        return $this->render('admin/legal/edit.html.twig', [
            'form' => $form,
        ]);
    }

}
