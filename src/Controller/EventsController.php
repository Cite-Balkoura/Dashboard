<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/events')]
class EventsController extends AbstractController
{
    #[Route('', name: 'events')]
    public function index(): Response
    {
        return $this->render('events/index.html.twig');
    }
}