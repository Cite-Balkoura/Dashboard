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
     * @MongoDB\ReferenceOne(storeAs="id")
     */
    private Profile $profile;

    /**
     * @MongoDB\ReferenceOne(storeAs="id")
     */
    private Event $event;
}