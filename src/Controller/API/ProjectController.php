<?php

namespace App\Controller\API;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class ProjectController extends AbstractController
{

    #[Route('/api/projects', name: 'api_projects')]
    public function index(ProjectRepository $repository, Request $request): JsonResponse
    {
        $projects = $repository->paginateProjects($request->query->getInt('page', 1), 2);

        return $this->json($projects, 200, [], ['groups' => ['projects.index']]);
    }

    #[Route('/api/projects/{id}', name: 'api_projects_show', requirements: ['id' => Requirement::DIGITS])]
    public function show(Project $project): JsonResponse
    {
        return $this->json($project, 200, [], ['groups' => ['projects.index', 'projects.show']]);
    }
}