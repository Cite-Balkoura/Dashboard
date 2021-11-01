<?php

namespace App\Controller;

use App\Document\Common\Participation;
use App\Document\User;
use App\Repository\Common\ParticipationRepository;
use App\Repository\Common\ProfileRepository;
use App\Repository\EventRepository;
use App\Repository\Common\EventRepository as CommonEventRepository;
use App\Utils\TimeUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
                $participations = $participationRepository->findByProfileId($profile->getId());
            }
        }

        $events = $eventRepository->findAll();
        $startedEvents = array_filter($events, function (Event $event) { return $event->isStarted(); });
        $futureEvents = array_filter($events, function (Event $event) { return !$event->isStarted(); });

        return $this->render('events/index.html.twig', [
            'startedEvents' => $startedEvents,
            'futureEvents' => $futureEvents,
            'canRegister' => null !== $profile,
            'participations' => $participations
        ]);
    }

    #[Route('/event/{slug}', name: 'event', methods: ['GET'])]
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

    #[Route('/event/{slug}/register', name: 'eventRegister', methods: ['POST'])]
    public function eventRegister(string $slug, Request $request, EventRepository $eventRepository, CommonEventRepository $commonEventRepository, ProfileRepository $profileRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $event = $eventRepository->findOneBy(['slug' => $slug]);
        if (!$event || !$event->isAcceptRegistration())
            $this->createNotFoundException();

        $submittedToken = $request->request->get('token');
        if (!$this->isCsrfTokenValid('register-event-' . $event->getId(), $submittedToken))
            $this->createAccessDeniedException();

        $commonEvent = $commonEventRepository->findOneBy(['id' => $event->getCommonId()]);
        if (!$commonEvent)
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR);

        $participation = new Participation();
        $participation->setEvent($commonEvent);
        $participation->setProfile($profileRepository->findByDiscordId(intval($this->getUser()->getDiscordId())));
        $profileRepository->getDocumentManager()->persist($participation);
        $profileRepository->getDocumentManager()->flush();

        $this->addFlash('success', ['Inscription confirmée', 'Vous avez bien été inscrit à l\'événement ' . $event->getTitle() . '.']);
        return $this->redirectToRoute('event', ['slug' => $slug]);
    }
}