<?php

namespace App\Repository\Common;

use App\Document\Common\Profile;
use DateTime;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class ProfileRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Profile::class);
    }

    public function findByDiscordId(int $discordId): ?Profile
    {
        return $this->findOneBy(['discordId' => $discordId]);
    }
}