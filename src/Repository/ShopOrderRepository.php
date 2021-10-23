<?php

namespace App\Repository;

use App\Document\ShopOrder;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;

class ShopOrderRepository extends ServiceDocumentRepository
{

    public function __construct(ManagerRegistry $registry, ShopCategoryRepository $shopCategoryRepository)
    {
        parent::__construct($registry, ShopOrder::class);
    }

    public function getById(string $orderId): ?ShopOrder
    {
        return $this->findOneBy(['id' => $orderId]);
    }
}