<?php

namespace App\Repository;


use App\Document\Event;
use DateTime;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class EventRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function findNextEvent(): ?Event
    {
        return $this->createQueryBuilder()
            ->sort('startDate')
            ->field('startDate')->gt(new DateTime('now'))
            ->getQuery()
            ->getSingleResult();
    }
}