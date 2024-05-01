<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Project;
use App\Repository\FaqRepository;
use App\Repository\PostRepository;
use App\Repository\PostTagRepository;
use App\Repository\ProjectRepository;
use App\Repository\ReviewRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
        ]);
    }

    #[Route('/studio', name: 'studio')]
    public function studio(): Response
    {
        return $this->render('main/studio.html.twig');
    }

    #[Route('/tarifs', name: 'prices')]
    public function prices(): Response
    {
        return $this->render('main/prices.html.twig');
    }

    #[Route('/realisations', name: 'projects')]
    public function projects(ProjectRepository $repository, TagRepository $tagRepository): Response
    {
        $projects = $repository->findAll();
        $tags = $tagRepository->findAll();

        return $this->render('main/projects.html.twig', [
            'projects' => $projects,
            'tags' => $tags,
        ]);
    }

    #[Route('/realisations/{slug}', name: 'show')]
    public function show(Project $project, ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findById($project->getId());

        return $this->render('main/show.html.twig', [
            'project' => $project,
            'projects' => $projects,
        ]);
    }

    #[Route('/blog', name: 'posts')]
    public function posts(PostRepository $postRepository, PostTagRepository $postTagRepository): Response
    {
        $posts = $postRepository->findAll();
        $tags = $postTagRepository->findAll();

        return $this->render('main/posts.html.twig', [
            'posts' => $posts,
            'tags' => $tags,
        ]);
    }

    #[Route('/blog/{slug}', name: 'post')]
    public function post(Post $post, PostRepository $postRepository): Response
    {
        $posts = $postRepository->findById($post->getId());

        return $this->render('main/post.html.twig', [
            'post' => $post,
            'posts' => $posts,
        ]);
    }

    #[Route('/faq', name: 'faq')]
    public function faq(FaqRepository $faqRepository): Response
    {
        $faqs = $faqRepository->findAll();

        return $this->render('main/faq.html.twig', [
            'faqs' => $faqs,
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('main/contact.html.twig');
    }
}
