<?php

namespace App\Controller\Admin;

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

#[Route('/admin/projets', name: 'app_admin_project_')]
class ProjectController extends AbstractController
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
    public function index(ProjectRepository $repository, TagRepository $tagRepository, Request $request): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);
        $projects = $repository->findAll();
        $tags = $tagRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($tag);
            $this->em->flush();
            $this->addFlash('success', 'Tag créé avec succès');
            return $this->redirectToRoute('app_admin_project_index');
        }

        return $this->render('admin/project/index.html.twig', [
            'projects' => $projects,
            'tags' => $tags,
            'form' => $form
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/new', name: 'new', methods: ['POST', 'GET'])]
    public function new(Request $request, ImageService $service): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        $issue = 0;
        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('images')->getData();
            $folder = 'projects/gallery';
            foreach ($images as $image) {
                $issue++;
                $file = $service->add($image, $folder, $this->width, $this->height);
                $img = new ProjectImage();
                $img->setName($file);
                $img->setIssue($issue);
                $project->addImage($img);
            }

            $image = $form->get('image')->getData();
            $folder = 'projects/featured';
            if ($image !== null) {
                $file = $service->add($image, $folder, $this->width, $this->height);
                $project->setImage($file);
            }
            $this->em->persist($project);
            $this->em->flush();
            $this->addFlash('success', 'Projet créé avec succès');
            return $this->redirectToRoute('app_admin_project_index');
        }

        return $this->render('admin/project/new.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/edit/{id}', name: 'edit', methods: ['POST', 'GET'])]
    public function edit(Project $project, ProjectImageRepository $repository, Request $request, ImageService $service): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        $lastIssue = $repository->findOneBy(['project' => $project->getId()], ['issue' => 'DESC']);
        if ($lastIssue) {
            $issue = $lastIssue->getIssue();
        } else {
            $issue = 0;
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('images')->getData();
            $folder = 'projects/gallery';
            foreach ($images as $image) {
                $issue++;
                $file = $service->add($image, $folder, $this->width, $this->height);
                $img = new ProjectImage();
                $img->setName($file);
                $img->setIssue($issue);
                $project->addImage($img);
            }

            $image = $form->get('image')->getData();
            $folder = 'projects/featured';
            if ($image !== null) {
                if ($project->getImage()) {
                    $service->delete($project->getImage(), $folder, $this->width, $this->height);
                }
                $file = $service->add($image, $folder, $this->width, $this->height);
                $project->setImage($file);
            }

            $this->em->persist($project);
            $this->em->flush();
            $this->addFlash('success', 'Projet édité avec succès');
            return $this->redirectToRoute('app_admin_project_edit', ['id' => $project->getId()]);
        }

        return $this->render('admin/project/edit.html.twig', [
            'form' => $form,
            'project' => $project,
            'width' => $this->width,
            'height' => $this->height
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(Project $project, ProjectImageRepository $imageRepository, ImageService $service): Response
    {
        if ($project->getImage()) {
            $folder = 'projects/featured';
            $service->delete($project->getImage(), $folder, $this->width, $this->height);
        }
        $images = $imageRepository->findBy(['project' => $project->getId()]);

        foreach($images as $image) {
            $folder = 'projects/gallery';
            $service->delete($image->getName(), $folder, $this->width, $this->height);
        }

        $this->em->remove($project);
        $this->em->flush();
        $this->addFlash('danger', 'Projet supprimé avec succès');
        return $this->redirectToRoute('app_admin_project_index');
    }

    #[Route('/tags/edit/{id}', name: 'tag_edit', methods: ['POST', 'GET'])]
    public function tagEdit(Tag $tag, Request $request): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($tag);
            $this->em->flush();
            $this->addFlash('success', 'Tag modifié avec succès');
            return $this->redirectToRoute('app_admin_project_index');
        }

        return $this->render('admin/project/tag/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/tags/delete/{id}', name: 'tag_delete', methods: 'DELETE')]
    public function tagDelete(Tag $tag): Response
    {
        $this->em->remove($tag);
        $this->em->flush();
        $this->addFlash('danger', 'Tag supprimé avec succès');
        return $this->redirectToRoute('app_admin_project_index');
    }

    #[Route('/image/delete/{id}', name: 'image_delete', methods: 'DELETE')]
    public function imageDelete(Project $project, ImageService $service): Response
    {
        if ($project->getImage()) {
            $folder = 'projects/featured';
            $service->delete($project->getImage(), $folder, $this->width, $this->height);
        }
        $project->setImage(null);
        $this->em->flush();
        $this->addFlash('danger', 'Image supprimée avec succès');
        return $this->redirectToRoute('app_admin_project_edit', ['id' => $project->getId()]);
    }

    #[Route('/images/delete/{id}', name: 'images_delete', methods: 'DELETE')]
    public function imagesDelete(ProjectImage $image, ProjectImageRepository $repository, ImageService $service): Response
    {
        if ($image->getId()) {
            $folder = 'projects/gallery';
            $service->delete($image->getName(), $folder, $this->width, $this->height);
        }
        $this->em->remove($image);
        $this->em->flush();
        $issue = 0;
        $images = $repository->findBy(['project' => $image->getProject()]);
        foreach ($images as $img) {
            $issue++;
            $img->setIssue($issue);
            $this->em->persist($img);
        }
        $this->em->flush();
        $this->addFlash('danger', 'Image supprimée avec succès');
        return $this->redirectToRoute('app_admin_project_edit', ['id' => $image->getProject()->getId()]);
    }

    #[Route('/images/next/{id}', name: 'images_next', methods: 'DELETE')]
    public function imagesNext(ProjectImage $image, ProjectImageRepository $repository, ImageService $service): Response
    {
        $issue = $image->getIssue();
        $issueNext = $issue + 1;
        $imageNext = $repository->findOneBy(['issue' => $issueNext, 'project' => $image->getProject()]);

        $image->setIssue($issueNext);
        $imageNext->setIssue($issue);
        $this->em->persist($image);
        $this->em->persist($imageNext);
        $this->em->flush();

        return $this->redirectToRoute('app_admin_project_edit', ['id' => $image->getProject()->getId()]);
    }

    #[Route('/images/prev/{id}', name: 'images_prev', methods: 'DELETE')]
    public function imagesPrev(ProjectImage $image, ProjectImageRepository $repository, ImageService $service): Response
    {
        $issue = $image->getIssue();
        $issuePrev = $issue - 1;
        $imagePrev = $repository->findOneBy(['issue' => $issuePrev, 'project' => $image->getProject()]);

        $image->setIssue($issuePrev);
        $imagePrev->setIssue($issue);
        $this->em->persist($image);
        $this->em->persist($imagePrev);
        $this->em->flush();

        return $this->redirectToRoute('app_admin_project_edit', ['id' => $image->getProject()->getId()]);
    }
}