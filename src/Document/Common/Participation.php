<?php

namespace App\Document\Common;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Participation
 * @package App\Document
 * @MongoDB\Document(collection="participation", db="master")
 */
class Participation
{

    /**
     * @MongoDB\Id(type="string")
     */
    private string $id;

    /**
     * @MongoDB\Field
     */
    private string $_t = "Participation";

    /**
     * @MongoDB\ReferenceOne(storeAs="id", targetDocument="App\Document\Common\Profile")
     */
    private Profile $profile;

    /**
     * @MongoDB\ReferenceOne(storeAs="id", targetDocument="App\Document\Common\Event")
     */
    private Event $event;

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
     * @return Profile
     */
    public function getProfile(): Profile
    {
        return $this->profile;
    }

    /**
     * @param Profile $profile
     */
    public function setProfile(Profile $profile): void
    {
        $this->profile = $profile;
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @param Event $event
     */
    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }

}