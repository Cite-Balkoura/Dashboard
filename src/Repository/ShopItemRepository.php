<?php

namespace App\Repository;

use App\Document\ShopItem;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class ShopItemRepository extends ServiceDocumentRepository
{

    private ShopCategoryRepository $shopCategoryRepository;

    public function __construct(ManagerRegistry $registry, ShopCategoryRepository $shopCategoryRepository)
    {
        $this->shopCategoryRepository = $shopCategoryRepository;
        parent::__construct($registry, ShopItem::class);
    }

    public function getBySlug(string $slug): ?ShopItem
    {
        return $this->createQueryBuilder()
            ->field('slug')->equals($slug)
            ->sort('position')
            ->getQuery()
            ->getSingleResult();
    }

    public function getByCategorySlug(string $slug): array
    {
        $category = $this->shopCategoryRepository->findBySlug($slug);
        if (null == $category)
            return [];

        return $this->createQueryBuilder()
            ->field('category')->equals($category)
            ->sort('position')
            ->getQuery()
            ->toArray();
    }
}