<?php

namespace App\Controller;

use AllowDynamicProperties;
use App\Repository\PostRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AllowDynamicProperties] class SitemapController extends AbstractController
{
    public function __construct(ProjectRepository $projectRepository, PostRepository $postRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->postRepository = $postRepository;
    }

    #[Route('/sitemap.xml', name: 'sitemap')]
    public function index(): Response
    {
        $urls = [];

        $urls[] = [
            'loc' => $this->generateUrl(
                'app_index',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'lastmod' => '2024-05-09',
            'changefreq' => 'monthly',
            'priority' => '1',
        ];

        $urls[] = [
            'loc' => $this->generateUrl(
                'app_service_branding',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'lastmod' => '2024-05-09',
            'changefreq' => 'monthly',
            'priority' => '1',
        ];

        $urls[] = [
            'loc' => $this->generateUrl(
                'app_service_webdesign',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'lastmod' => '2024-05-09',
            'changefreq' => 'monthly',
            'priority' => '1',
        ];

        $urls[] = [
            'loc' => $this->generateUrl(
                'app_service_development',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'lastmod' => '2024-05-09',
            'changefreq' => 'monthly',
            'priority' => '1',
        ];

        $urls[] = [
            'loc' => $this->generateUrl(
                'app_studio',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'lastmod' => '2024-05-09',
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];

        $urls[] = [
            'loc' => $this->generateUrl(
                'app_prices',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'lastmod' => '2024-05-09',
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];

        $urls[] = [
            'loc' => $this->generateUrl(
                'app_posts',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'lastmod' => '2024-05-09',
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];

        $urls[] = [
            'loc' => $this->generateUrl(
                'app_projects',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'lastmod' => '2024-05-09',
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];

        $urls[] = [
            'loc' => $this->generateUrl(
                'app_faq',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'lastmod' => '2024-05-09',
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];

        $projects = $this->projectRepository->findAll();
        foreach ($projects as $project) {
            $urls[] = [
                'loc' => $this->generateUrl(
                    'app_show',
                    ['slug' => $project->getSlug()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                'lastmod' => $project->getUpdatedAt()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.5',
            ];
        }

        $posts = $this->postRepository->findAll();
        foreach ($posts as $post) {
            $urls[] = [
                'loc' => $this->generateUrl(
                        'app_post',
                        ['slug' => $post->getSlug()],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    ),
                'lastmod' => $project->getUpdatedAt()->format('Y-m-d'),
                'changefreq' => 'weekly',
                'priority' => '0.5',
            ];
        }

        $response = new Response(
            $this->renderView('sitemap/sitemap.html.twig', ['urls' => $urls]),
            200
        );
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}