<?php

namespace App\Controller;

use App\Document\User;
use App\Repository\Common\ParticipationRepository;
use App\Repository\Common\ProfileRepository;
use App\Repository\EventRepository;
use App\Utils\TimeUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/events', name: 'events')]
    public function index(EventRepository $eventRepository, ProfileRepository $profileRepository, ParticipationRepository $participationRepository): Response
    {
        $profile = null;
        $participations = [];

        /** @var User $user */
        if ($user = $this->getUser()) {
            if ($profile = $profileRepository->findByDiscordId(intval($user->getDiscordId()))) {
                $participations = $participationRepository->findByProfileId(intval($profile->getId()));
            }
        }

        return $this->render('events/index.html.twig', [
            'events' => $eventRepository->findAll(),
            'canRegister' => null !== $profile,
            'participations' => $participations
        ]);
    }

    #[Route('/event/{slug}', name: 'event')]
    public function event(string $slug, EventRepository $eventRepository): Response
    {
        $event = $eventRepository->findOneBy(['slug' => $slug]);
        if (!$event)
            return $this->redirectToRoute('index');
        return $this->render('events/event.html.twig', [
            'event' => $event,
            'countdown' => TimeUtils::getCountdownValues($event->getStartDate())
        ]);
    }
}