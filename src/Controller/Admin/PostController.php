<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\PostTag;
use App\Form\PostTagType;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\PostTagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ImageService;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/admin/articles', name: 'app_admin_post_')]
class PostController extends AbstractController
{

    private EntityManagerInterface $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'index')]
    public function index(PostRepository $repository, PostTagRepository $tagRepository, Request $request): Response
    {
        $tag = new PostTag();
        $form = $this->createForm(PostTagType::class, $tag);
        $form->handleRequest($request);
        $tags = $tagRepository->findAll();
        $posts = $repository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($tag);
            $this->em->flush();
            $this->addFlash('success', 'Tag créé avec succès');
            return $this->redirectToRoute('app_admin_post_index');
        }

        return $this->render('admin/post/index.html.twig', [
            'posts' => $posts,
            'tags' => $tags,
            'form' => $form,
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/new', name: 'new', methods: ['POST', 'GET'])]
    public function new(Request $request, ImageService $service): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $folder = 'posts/featured';
            if ($image !== null) {
                $file = $service->add($image, $post->getSlug(), $folder);
                $post->setImage($file);
            }
            $user = $this->getUser();
            if ($user) {
                $author = $user->getFirstname() . ' ' . $user->getLastname() . ' <br> ' . '(' . $user->getJob() .')';
                $post->setAuthor($author);
            }

            $this->em->persist($post);
            $this->em->flush();
            $this->addFlash('success', 'Article créé avec succès');
            return $this->redirectToRoute('app_admin_post_index');
        }

        return $this->render('admin/post/new.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/edit/{id}', name: 'edit', methods: ['POST', 'GET'])]
    public function edit(Post $post, Request $request, ImageService $service): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $folder = 'posts/featured';
            if ($image !== null) {
                if ($post->getImage()) {
                    $service->delete($post->getImage(), $folder);
                }
                $file = $service->add($image, $post->getSlug(), $folder);
                $post->setImage($file);
            }
            $user = $this->getUser();
            if ($user) {
                $author = $user->getFirstname() . ' ' . $user->getLastname() . ' <br> ' . '(' . $user->getJob() .')';
                $post->setAuthor($author);
            }

            $this->em->persist($post);
            $this->em->flush();
            $this->addFlash('success', 'Article édité avec succès');
            return $this->redirectToRoute('app_admin_post_edit', ['id' => $post->getId()]);
        }

        return $this->render('admin/post/edit.html.twig', [
            'form' => $form,
            'post' => $post
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(Post $post, ImageService $service): Response
    {
        if ($post->getImage()) {
            $folder = 'posts/featured';
            $service->delete($post->getImage(), $folder);
        }
        $this->em->remove($post);
        $this->em->flush();
        $this->addFlash('danger', 'Article supprimé avec succès');
        return $this->redirectToRoute('app_admin_post_index');
    }

    #[Route('/tags/edit/{id}', name: 'tag_edit', methods: ['POST', 'GET'])]
    public function tagEdit(PostTag $tag, Request $request): Response
    {
        $form = $this->createForm(PostTagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($tag);
            $this->em->flush();
            $this->addFlash('success', 'Tag modifié avec succès');
            return $this->redirectToRoute('app_admin_post_index');
        }

        return $this->render('admin/post/tag/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/tags/delete/{id}', name: 'tag_delete', methods: 'DELETE')]
    public function tagDelete(PostTag $tag): Response
    {
        $this->em->remove($tag);
        $this->em->flush();
        $this->addFlash('danger', 'Tag supprimé avec succès');
        return $this->redirectToRoute('app_admin_post_index');
    }

    #[Route('/image/delete/{id}', name: 'image_delete', methods: 'DELETE')]
    public function imageDelete(Post $post, ImageService $service): Response
    {
        if ($post->getImage()) {
            $folder = 'posts/featured';
            $service->delete($post->getImage(), $folder);
        }
        $post->setImage(null);
        $this->em->flush();
        $this->addFlash('danger', 'Image supprimée avec succès');
        return $this->redirectToRoute('app_admin_post_edit', ['id' => $post->getId()]);
    }
}