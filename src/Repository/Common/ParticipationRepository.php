<?php

namespace App\Repository\Common;

use App\Document\Common\Participation;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class ParticipationRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participation::class);
    }

    public function findByProfileId(string $profileId): array
    {
        return $this->createQueryBuilder()
            ->field('profile')->equals($profileId)
            ->select(['event'])
            ->getQuery()
            ->toArray();
    }

    public function getParticipation(string $profileId, string $eventId): Participation
    {
        return $this->createQueryBuilder()
            ->field('profile')->equals($profileId)
            ->field('event')->equals($eventId)
            ->getQuery()
            ->getSingleResult();
    }
}