<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Entity\Post;
use App\Entity\Project;
use App\Form\ContactType;
use App\Repository\FaqRepository;
use App\Repository\PostRepository;
use App\Repository\PostTagRepository;
use App\Repository\ProjectRepository;
use App\Repository\ReviewRepository;
use App\Repository\TagRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        ]);
    }

    #[Route('/studio', name: 'studio')]
    public function studio(ReviewRepository $reviewRepository, FaqRepository $faqRepository): Response
    {
        $reviews = $reviewRepository->findAll();
        $faqs = $faqRepository->findBy(['category' => 'general']);

        return $this->render('main/studio.html.twig', [
            'reviews' => $reviews,
            'faqs' => $faqs
        ]);
    }

    #[Route('/tarifs', name: 'prices')]
    public function prices(): Response
    {
        return $this->render('main/prices.html.twig');
    }

    #[Route('/projets', name: 'projects')]
    public function projects(ProjectRepository $repository, TagRepository $tagRepository): Response
    {
        $projects = $repository->findAll();
        $tags = $tagRepository->findAll();

        return $this->render('main/projects.html.twig', [
            'projects' => $projects,
            'tags' => $tags,
        ]);
    }

    #[Route('/projets/{slug}', name: 'show')]
    public function show(Project $project, ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findById($project->getId());

        return $this->render('main/show.html.twig', [
            'project' => $project,
            'projects' => $projects,
        ]);
    }

    #[Route('/articles', name: 'posts')]
    public function posts(PostRepository $postRepository, PostTagRepository $postTagRepository): Response
    {
        $posts = $postRepository->findAll();
        $tags = $postTagRepository->findAll();

        return $this->render('main/posts.html.twig', [
            'posts' => $posts,
            'tags' => $tags,
        ]);
    }

    #[Route('/articles/{slug}', name: 'post')]
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
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $data = new ContactDTO();
        $form = $this->createForm(ContactType::class, $data);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
                ->from('hello@studiokhi.com')
                ->to('stefan@studiokhi.com')
                ->replyTo($data->email)
                ->cc('cynthia@studiokhi.com')
                ->subject('Nouveau message depuis studiokhi.com')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'data' => $data
                ]);
            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                echo $e->getMessage();
            }

            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('main/contact.html.twig', [
            'form' => $form,
        ]);
    }
}
