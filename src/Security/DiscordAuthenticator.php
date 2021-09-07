<?php

namespace App\Security;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use Romitou\OAuth2\Client\DiscordRessourceOwner;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Twig\Environment;

class DiscordAuthenticator extends OAuth2Authenticator
{
    private ClientRegistry $clientRegistry;
    private DocumentManager $dm;
    private RouterInterface $router;
    private Environment $twig;

    public function __construct(ClientRegistry $clientRegistry, DocumentManager $entityManager, RouterInterface $router, Environment $twig)
    {
        $this->clientRegistry = $clientRegistry;
        $this->dm = $entityManager;
        $this->router = $router;
        $this->twig = $twig;
    }

    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'connect_discord_check';
    }

    public function authenticate(Request $request): PassportInterface
    {
        $client = $this->clientRegistry->getClient('discord');
        $accessToken = $this->fetchAccessToken($client);

        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function () use ($accessToken, $client) {
                /** @var DiscordRessourceOwner $resourceOwner */
                $resourceOwner = $client->fetchUserFromToken($accessToken);

                $existingUser = $this->dm
                    ->getRepository(User::class)
                    ->findOneBy(['discordId' => $resourceOwner->getId()]);

                if ($existingUser) {
                    return $existingUser;
                }

                $user = new User();
                $user->setUsername($resourceOwner->getCompleteUsername());
                $user->setAvatarUrl($resourceOwner->getAvatarUrl('.webp'));
                $user->setDiscordId($resourceOwner->getId());

                $this->dm->persist($user);
                $this->dm->flush();

                return $user;
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse($this->router->generate('index'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new Response($this->twig->render('auth/error.html.twig', [
            'deniedAccess' => 'access_denied' == $request->query->get('error')
        ]));
    }
}
