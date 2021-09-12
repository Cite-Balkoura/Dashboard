<?php

namespace App\Controller;

use App\Document\Event;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/events')]
class EventsController extends AbstractController
{
    #[Route('', name: 'events')]
    public function index(DocumentManager $dm): Response
    {
        return $this->render('events/index.html.twig', [
            'events' => $dm->getRepository(Event::class)->findAll()
        ]);
    }
}