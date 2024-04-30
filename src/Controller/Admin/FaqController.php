<?php

namespace App\Controller\Admin;

use App\Entity\Faq;
use App\Form\FaqType;
use App\Repository\FaqRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[\Symfony\Component\Routing\Annotation\Route('/admin/faq', name: 'app_admin_')]
class FaqController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'faq', methods: ['POST', 'GET'])]
    public function index(Request $request, FaqRepository $faqRepository): Response
    {
        $faq = new Faq();
        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);
        $faqs = $faqRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($faq);
            $this->em->flush();
            $this->addFlash('success', 'Question créée avec succès');
            return $this->redirectToRoute('app_admin_faq');
        }

        return $this->render('admin/faq/index.html.twig', [
            'form' => $form,
            'faqs' => $faqs,
        ]);
    }

    #[Route('/edit/{id}', name: 'faq_edit', methods: ['POST', 'GET'])]
    public function editFaq(Faq $faq, Request $request): Response
    {
        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($faq);
            $this->em->flush();
            $this->addFlash('success', 'Question éditée avec succès');
            return $this->redirectToRoute('app_admin_faq');
        }

        return $this->render('admin/faq/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'faq_delete', methods: ['DELETE'])]
    public function deleteFaq(Faq $faq): Response
    {
        $this->em->remove($faq);
        $this->em->flush();
        $this->addFlash('danger', 'Question supprimée avec succès');
        return $this->redirectToRoute('app_admin_faq');
    }
}
