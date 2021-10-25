<?php

namespace App\Document\Common;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Event
 * @package App\Document
 * @MongoDB\Document(collection="event", db="master")
 */
class Event
{
    /**
     * @MongoDB\Id(type="string")
     */
    private string $id;

    /**
     * @MongoDB\Field
     */
    private string $_t = "Event";

    /**
     * @MongoDB\Field
     */
    private string $name;

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
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}