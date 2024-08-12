<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Entity\Post;
use App\Entity\Project;
use App\Form\ContactType;
use App\Repository\FaqRepository;
use App\Repository\LegalRepository;
use App\Repository\PostRepository;
use App\Repository\PostTagRepository;
use App\Repository\ProjectRepository;
use App\Repository\ReviewRepository;
use App\Repository\TagRepository;
use DateTime;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('', name: 'app_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProjectRepository $projectRepository, PostRepository $postRepository, FaqRepository $faqRepository, ReviewRepository $reviewRepository): Response
    {
        $projects = $projectRepository->findBy(['is_homepage' => true]);
        $posts = $postRepository->findBy(['is_homepage' => true]);
        $faqs = $faqRepository->findBy(['category' => 'general']);
        $reviews = $reviewRepository->findAll();

        return $this->render('main/index.html.twig', [
            'projects' => $projects,
            'faqs' => $faqs,
            'posts' => $posts,
            'reviews' => $reviews,
            'footer' => true
        ]);
    }

    #[Route('/services/branding-et-direction-artistique', name: 'service_branding')]
    public function branding(FaqRepository $faqRepository): Response
    {
        $faqs = $faqRepository->findBy(['category' => 'branding']);

        return $this->render('main/service/branding.html.twig', [
            'faqs' => $faqs,
            'footer' => true
        ]);
    }

    #[Route('/services/webdesign-et-design-digital', name: 'service_webdesign')]
    public function webdesign(FaqRepository $faqRepository): Response
    {
        $faqs = $faqRepository->findBy(['category' => 'webdesign']);

        return $this->render('main/service/webdesign.html.twig', [
            'faqs' => $faqs,
            'footer' => true
        ]);
    }

    #[Route('/services/sites-sur-mesure', name: 'service_development')]
    public function development(FaqRepository $faqRepository): Response
    {
        $faqs = $faqRepository->findBy(['category' => 'website']);

        return $this->render('main/service/development.html.twig', [
            'faqs' => $faqs,
            'footer' => true
        ]);
    }

    #[Route('/studio', name: 'studio')]
    public function studio(ReviewRepository $reviewRepository, FaqRepository $faqRepository): Response
    {
        $reviews = $reviewRepository->findAll();
        $faqs = $faqRepository->findBy(['category' => 'general']);

        return $this->render('main/studio.html.twig', [
            'reviews' => $reviews,
            'faqs' => $faqs,
            'footer' => true
        ]);
    }

    #[Route('/tarifs', name: 'prices')]
    public function prices(): Response
    {
        return $this->render('main/prices.html.twig');
    }

    #[Route('/realisations', name: 'projects')]
    public function projects(ProjectRepository $repository, TagRepository $tagRepository): Response
    {
        $projects = $repository->findBy([], ['issue' => 'ASC']);
        $tags = $tagRepository->findAll();

        return $this->render('main/projects.html.twig', [
            'projects' => $projects,
            'tags' => $tags,
            'footer' => true
        ]);
    }

    #[Route('/realisations/{slug}', name: 'show')]
    public function show(Project $project, ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findById($project->getId());

        return $this->render('main/show.html.twig', [
            'project' => $project,
            'projects' => $projects,
            'footer' => true
        ]);
    }

    #[Route('/articles', name: 'posts')]
    public function posts(PostRepository $postRepository, PostTagRepository $postTagRepository): Response
    {
        $posts = $postRepository->findBy([], ['updated_at' => 'DESC']);
        $tags = $postTagRepository->findAll();

        return $this->render('main/posts.html.twig', [
            'posts' => $posts,
            'tags' => $tags,
            'footer' => true
        ]);
    }

    #[Route('/articles/{slug}', name: 'post')]
    public function post(Post $post, PostRepository $postRepository): Response
    {
        $posts = $postRepository->findById($post->getId());

        return $this->render('main/post.html.twig', [
            'post' => $post,
            'posts' => $posts,
            'footer' => true
        ]);
    }

    #[Route('/faq', name: 'faq')]
    public function faq(FaqRepository $faqRepository): Response
    {
        $faqs = $faqRepository->findAll();

        return $this->render('main/faq.html.twig', [
            'faqs' => $faqs,
            'footer' => true
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        return $this->render('main/contact.html.twig', [
            'footer' => false
        ]);
    }

    #[Route('/mentions-legales', name: 'legal_notice')]
    public function legalNotice(LegalRepository $legalRepository): Response
    {
        $legal = $legalRepository->findOneBy(['id' => 1]);
        return $this->render('legal/legal-notice.html.twig', [
            'legal' => $legal,
            'footer' => true
        ]);
    }

    #[Route('/politique-de-confidentialite', name: 'privacy_policy')]
    public function privacyPolicy(LegalRepository $legalRepository): Response
    {
        $legal = $legalRepository->findOneBy(['id' => 1]);
        return $this->render('legal/privacy-policy.html.twig', [
            'legal' => $legal,
            'footer' => true
        ]);
    }

    #[Route('/cookies', name: 'cookies')]
    public function cookies(LegalRepository $legalRepository): Response
    {
        $legal = $legalRepository->findOneBy(['id' => 1]);
        return $this->render('legal/cookies.html.twig', [
            'legal' => $legal,
            'footer' => true
        ]);
    }
}
