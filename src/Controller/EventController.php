<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/events', name: 'events')]
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('events/index.html.twig', [
            'events' => $eventRepository->findAll()
        ]);
    }

    #[Route('/event/{slug}', name: 'event')]
    public function event(string $slug, EventRepository $eventRepository): Response
    {
        return $this->render('events/event.html.twig', [
            'event' => $eventRepository->findOneBy(['slug' => $slug])
        ]);
    }
}