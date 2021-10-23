<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class ShopItem
 * @package App\Document
 * @MongoDB\Document(collection="shopItems", repositoryClass="App\Repository\EventRepository")
 */
class ShopItem
{

    /**
     * @MongoDB\Id(type="string")
     */
    private string $id;

    /**
     * @MongoDB\ReferenceOne(targetDocument=ShopCategory::class)
     */
    private ShopCategory $category;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $name;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $description;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $slug;

    /**
     * @MongoDB\Field(type="collection")
     */
    private array $images = [];

    /**
     * @MongoDB\Field(type="float")
     */
    private float $price;

    /**
     * @MongoDB\Field(type="int")
     */
    private int $position;

    /**
     * @MongoDB\Field(type="bool")
     */
    private bool $limitedStock = false;

    /**
     * @MongoDB\Field(type="int")
     */
    private int $stock = 0;

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
     * @return ShopCategory
     */
    public function getCategory(): ShopCategory
    {
        return $this->category;
    }

    /**
     * @param ShopCategory $category
     */
    public function setCategory(ShopCategory $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    /**
     * @return bool
     */
    public function isLimitedStock(): bool
    {
        return $this->limitedStock;
    }

    /**
     * @param bool $limitedStock
     */
    public function setLimitedStock(bool $limitedStock): void
    {
        $this->limitedStock = $limitedStock;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

}