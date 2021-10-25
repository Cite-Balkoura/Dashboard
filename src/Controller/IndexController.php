<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Utils\TimeUtils;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class IndexController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(EventRepository $eventRepository): Response
    {
        $nextEvent = $eventRepository->findNextEvent();
        return $this->render('index.html.twig', [
            'nextEvent' => $nextEvent,
            'countdown' => TimeUtils::getCountdownValues($nextEvent->getStartDate())
        ]);
    }

    #[Route('login', name: 'login')]
    public function login(ClientRegistry $clientRegistry): RedirectResponse
    {
        return $clientRegistry->getClient('discord')->redirect(['identify']);
    }
}