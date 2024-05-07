<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\PostTag;
use App\Form\PostTagType;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\PostTagRepository;
use App\Repository\ProjectImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;
use App\Entity\ProjectImage;
use App\Entity\Tag;
use App\Form\ProjectType;
use App\Form\TagType;
use App\Repository\ProjectRepository;
use App\Repository\TagRepository;
use App\Service\ImageService;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/admin/articles', name: 'app_admin_post_')]
class PostController extends AbstractController
{

    private EntityManagerInterface $em;
    private int $width;
    private int $height;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->width = 150;
        $this->height = 150;
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
                $file = $service->add($image, $folder, $this->width, $this->height);
                $post->setImage($file);
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
                    $service->delete($project->getImage(), $folder, $this->width, $this->height);
                }
                $file = $service->add($image, $folder, $this->width, $this->height);
                $post->setImage($file);
            }

            $this->em->persist($post);
            $this->em->flush();
            $this->addFlash('success', 'Article édité avec succès');
            return $this->redirectToRoute('app_admin_post_edit', ['id' => $post->getId()]);
        }

        return $this->render('admin/post/edit.html.twig', [
            'form' => $form,
            'post' => $post,
            'width' => $this->width,
            'height' => $this->height
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(Post $post, ImageService $service): Response
    {
        if ($post->getImage()) {
            $folder = 'posts/featured';
            $service->delete($post->getImage(), $folder, $this->width, $this->height);
        }
        $this->em->remove($post);
        $this->em->flush();
        $this->addFlash('danger', 'Article supprimé avec succès');
        return $this->redirectToRoute('app_admin_post_index');
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
            $service->delete($post->getImage(), $folder, $this->width, $this->height);
        }
        $post->setImage(null);
        $this->em->flush();
        $this->addFlash('danger', 'Image supprimée avec succès');
        return $this->redirectToRoute('app_admin_post_edit', ['id' => $post->getId()]);
    }
}