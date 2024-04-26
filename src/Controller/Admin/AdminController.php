<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\Tag;
use App\Form\ProjectType;
use App\Form\TagType;
use App\Repository\ProjectRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'app_admin_')]
class AdminController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    #[Route('/projets', name: 'project')]
    public function project(ProjectRepository $repository, TagRepository $tagRepository, Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);
        $projects = $repository->findAll();
        $tags = $tagRepository->findAll();

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($tag);
            $this->em->flush();
            return $this->redirectToRoute('app_admin_project');
        }

        return $this->render('admin/project/index.html.twig', [
            'projects' => $projects,
            'tags' => $tags,
            'form' => $form
        ]);
    }

    #[Route('/projets/new', name: 'project_new', methods: ['POST', 'GET'])]
    public function new(Request $request): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($project);
            $this->em->flush();
            return $this->redirectToRoute('app_admin_project');
        }

        return $this->render('admin/project/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/projets/edit/{id}', name: 'project_edit', methods: ['POST', 'GET'])]
    public function edit(Project $project, Request $request): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($project);
            $this->em->flush();
            return $this->redirectToRoute('app_admin_project');
        }

        return $this->render('admin/project/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/projets/delete/{id}', name: 'project_delete', methods: 'DELETE')]
    public function delete(Project $project): Response
    {
        $this->em->remove($project);
        $this->em->flush();

        return $this->redirectToRoute('app_admin_project');
    }

    #[Route('/tags/delete/{id}', name: 'tag_delete', methods: 'DELETE')]
    public function tagDelete(Tag $tag): Response
    {
        $this->em->remove($tag);
        $this->em->flush();

        return $this->redirectToRoute('app_admin_project');
    }
}
