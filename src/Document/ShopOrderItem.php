<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use JetBrains\PhpStorm\Pure;

/**
 * Class ShopOrderItem
 * @package App\Document
 * @MongoDB\Document(collection="shopOrderItems")
 */
class ShopOrderItem
{
    /**
     * @MongoDB\Id(type="string")
     */
    private string $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument=ShopItem::class)
     */
    private ShopItem $item;

    /**
     * @MongoDB\Field(type="integer")
     */
    private int $quantity;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return ShopItem
     */
    public function getItem(): ShopItem
    {
        return $this->item;
    }

    /**
     * @param ShopItem $item
     */
    public function setItem(ShopItem $item): void
    {
        $this->item = $item;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    #[Pure]
    public function equals(ShopOrderItem $item): bool
    {
        return $this->getItem()->getId() === $item->getItem()->getId();
    }

    #[Pure]
    public function getTotal(): float
    {
        return $this->getItem()->getPrice() * $this->getQuantity();
    }
}