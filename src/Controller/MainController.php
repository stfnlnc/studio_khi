<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', name: 'app_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    #[Route('/service/{slug}', name: 'service')]
    public function service(): Response
    {
        return $this->render('main/service.html.twig');
    }

    #[Route('/studio', name: 'studio')]
    public function studio(): Response
    {
        return $this->render('main/studio.html.twig');
    }

    #[Route('/realisations', name: 'projects')]
    public function projects(): Response
    {
        return $this->render('main/projects.html.twig');
    }

    #[Route('/realisations/{slug}', name: 'show')]
    public function show(): Response
    {
        return $this->render('main/show.html.twig');
    }

    #[Route('/blog', name: 'posts')]
    public function posts(): Response
    {
        return $this->render('main/posts.html.twig');
    }

    #[Route('/blog/{slug}', name: 'post')]
    public function post(): Response
    {
        return $this->render('main/post.html.twig');
    }

    #[Route('/faq', name: 'faq')]
    public function faq(): Response
    {
        return $this->render('main/faq.html.twig');
    }
}
