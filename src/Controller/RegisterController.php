<?php

namespace App\Controller;

use App\Document\User;
use App\Repository\Common\ProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/register')]
class RegisterController extends AbstractController
{
    #[Route('', name: 'register')]
    public function index(ProfileRepository $profileRepository): Response
    {
        if ($this->isGranted('ROLE_USER')) {
            /** @var User $user */
            $user = $this->getUser();
            $profile = $profileRepository->findByDiscordId(intval($user->getDiscordId()));
        }

        return $this->render('register/index.html.twig', [
            'profile' => $profile ?? null
        ]);
    }
}