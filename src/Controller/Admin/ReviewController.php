<?php

namespace App\Controller\Admin;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/avis', name: 'app_admin_review_')]
class ReviewController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'index')]
    public function index(ReviewRepository $reviewRepository): Response
    {
        $reviews = $reviewRepository->findAll();

        return $this->render('admin/review/index.html.twig', [
            'reviews' => $reviews,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['POST', 'GET'])]
    public function new(Request $request): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($review);
            $this->em->flush();
            $this->addFlash('success', 'Avis créé avec succès');
            return $this->redirectToRoute('app_admin_review');
        }

        return $this->render('admin/review/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['POST', 'GET'])]
    public function edit(Review $review, Request $request): Response
    {
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($review);
            $this->em->flush();
            $this->addFlash('success', 'Avis édité avec succès');
            return $this->redirectToRoute('app_admin_review_edit', ['id' => $review->getId()]);
        }

        return $this->render('admin/review/edit.html.twig', [
            'form' => $form,
            'review' => $review,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(Review $review): Response
    {
        $this->em->remove($review);
        $this->em->flush();
        $this->addFlash('danger', 'Avis supprimé avec succès');
        return $this->redirectToRoute('app_admin_review');
    }
}
