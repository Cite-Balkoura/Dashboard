<?php

namespace App\Repository;

use App\Document\ShopCategory;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class ShopCategoryRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopCategory::class);
    }

    public function findBySlug(string $slug): ?ShopCategory
    {
        return $this->findOneBy(['slug' => $slug]);
    }
}