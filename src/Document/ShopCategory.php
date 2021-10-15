<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class ShopCategory
 * @package App\Document
 * @MongoDB\Document(collection="shopCategories", repositoryClass="App\Repository\EventRepository")
 */
class ShopCategory
{

    /**
     * @MongoDB\Id(type="string")
     */
    private string $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $name;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $slug;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $svg;

    /**
     * @MongoDB\Field(type="int")
     */
    private int $position;

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSvg(): string
    {
        return $this->svg;
    }

    /**
     * @param string $svg
     */
    public function setSvg(string $svg): void
    {
        $this->svg = $svg;
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

}