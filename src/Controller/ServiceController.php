<?php

namespace App\Controller;

use App\Repository\FaqRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/service', name: 'app_service_')]
class ServiceController extends AbstractController
{
    #[Route('/branding-et-direction-artistique', name: 'branding')]
    public function branding(FaqRepository $faqRepository): Response
    {
        $faqs = $faqRepository->findBy(['category' => 'branding']);

        return $this->render('service/branding.html.twig', [
            'faqs' => $faqs,
        ]);
    }

    #[Route('/webdesign-et-design-digital', name: 'webdesign')]
    public function webdesign(FaqRepository $faqRepository): Response
    {
        $faqs = $faqRepository->findBy(['category' => 'webdesign']);

        return $this->render('service/webdesign.html.twig', [
            'faqs' => $faqs,
        ]);
    }

    #[Route('/sites-sur-mesure', name: 'development')]
    public function development(FaqRepository $faqRepository): Response
    {
        $faqs = $faqRepository->findBy(['category' => 'website']);

        return $this->render('service/development.html.twig', [
            'faqs' => $faqs,
        ]);
    }
}
