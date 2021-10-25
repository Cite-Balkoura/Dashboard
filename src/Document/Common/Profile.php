<?php

namespace App\Document\Common;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Profile
 * @package App\Document
 * @MongoDB\Document(collection="profile", db="master")
 */
class Profile
{

    /**
     * @MongoDB\Id(type="string")
     */
    private string $id;

    /**
     * @MongoDB\Field
     */
    private string $_t = "Profile";

    /**
     * @MongoDB\Field(type="int")
     */
    private int $discordId;

    /**
     * @MongoDB\Field
     */
    private string $username;

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
     * @return int
     */
    public function getDiscordId(): int
    {
        return $this->discordId;
    }

    /**
     * @param int $discordId
     */
    public function setDiscordId(int $discordId): void
    {
        $this->discordId = $discordId;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
}