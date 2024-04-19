<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UIController extends AbstractController
{
    #[Route('/ui', name: 'app_ui')]
    public function index(): Response
    {
        return $this->render('ui/index.html.twig');
    }
}
