<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeoController extends AbstractController
{
    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    #[Route('/robots.txt', name: 'robots')]
    public function robots(Request $request): Response
    {
        return new Response($this->renderView('robots.txt.twig', [
            'hostname' => $request->getSchemeAndHttpHost()
        ]), Response::HTTP_OK, [
            'Content-Type' => 'text/plain'
        ]);
    }

    #[Route('/sitemap.xml', name: 'sitemap')]
    public function sitemap(Request $request): Response
    {
        $urls = [
            [
                'loc' => $this->generateUrl('index'),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
            [
                'loc' => $this->generateUrl('register'),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
            [
                'loc' => $this->generateUrl('events'),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
            [
                'loc' => $this->generateUrl('events'),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ]
        ];

        $events = $this->generateEvents();
        $urls = array_merge($urls, $events);

        return new Response($this->renderView('sitemap.xml.twig', [
            'hostname' => $request->getSchemeAndHttpHost(),
            'urls' => $urls
        ]), Response::HTTP_OK, [
            'Content-Type' => 'text/xml'
        ]);
    }

    public function generateEvents(): array
    {
        $events = $this->eventRepository->findAll();
        $urls = [];
        foreach ($events as $event) {
            $urls[] = [
                'loc' => $this->generateUrl('event', ['slug' => $event->getSlug()]),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ];
        }
        return $urls;
    }

}