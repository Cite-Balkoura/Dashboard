<?php

namespace App\Document;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Event
 * @package App\Document
 * @MongoDB\Document(collection="events", repositoryClass="App\Repository\EventRepository")
 */
class Event
{

    /**
     * @MongoDB\Id(type="string")
     */
    private string $id;

    /**
     * @MongoDB\ReferenceOne(storeAs="id", targetDocument="App\Document\Common\Event")
     */
    private string $commonId;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $title;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $slug;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $shortDescription;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $description;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $story;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $goal;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $cashprize;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $rules;

    /**
     * @MongoDB\Field(type="string")
     */
    private ?string $calendar = null;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $banner;

    /**
     * @MongoDB\Field(type="string")
     */
    private ?string $largeBanner = null;

    /**
     * @MongoDB\Field(type="string")
     */
    private string $registration;

    /**
     * @MongoDB\Field(type="bool")
     */
    private bool $acceptRegistration = false;

    /**
     * @MongoDB\Field(type="date")
     */
    private DateTime $startDate;

    /**
     * @MongoDB\Field(type="date")
     */
    private DateTime $endDate;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
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
    public function getStory(): string
    {
        return $this->story;
    }

    /**
     * @param string $story
     */
    public function setStory(string $story): void
    {
        $this->story = $story;
    }

    /**
     * @return string
     */
    public function getGoal(): string
    {
        return $this->goal;
    }

    /**
     * @param string $goal
     */
    public function setGoal(string $goal): void
    {
        $this->goal = $goal;
    }

    /**
     * @return string
     */
    public function getCashprize(): string
    {
        return $this->cashprize;
    }

    /**
     * @param string $cashprize
     */
    public function setCashprize(string $cashprize): void
    {
        $this->cashprize = $cashprize;
    }

    /**
     * @return string
     */
    public function getRules(): string
    {
        return $this->rules;
    }

    /**
     * @param string $rules
     */
    public function setRules(string $rules): void
    {
        $this->rules = $rules;
    }

    /**
     * @return string|null
     */
    public function getCalendar(): ?string
    {
        return $this->calendar;
    }

    /**
     * @param string|null $calendar
     */
    public function setCalendar(?string $calendar): void
    {
        $this->calendar = $calendar;
    }

    /**
     * @return string
     */
    public function getBanner(): string
    {
        return $this->banner;
    }

    /**
     * @param string $banner
     */
    public function setBanner(string $banner): void
    {
        $this->banner = $banner;
    }

    /**
     * @return string|null
     */
    public function getLargeBanner(): ?string
    {
        return $this->largeBanner;
    }

    /**
     * @param string|null $largeBanner
     */
    public function setLargeBanner(?string $largeBanner): void
    {
        $this->largeBanner = $largeBanner;
    }

    /**
     * @return string
     */
    public function getRegistration(): string
    {
        return $this->registration;
    }

    /**
     * @param string $registration
     */
    public function setRegistration(string $registration): void
    {
        $this->registration = $registration;
    }

    /**
     * @return bool
     */
    public function isAcceptRegistration(): bool
    {
        return $this->acceptRegistration;
    }

    /**
     * @param bool $acceptRegistration
     */
    public function setAcceptRegistration(bool $acceptRegistration): void
    {
        $this->acceptRegistration = $acceptRegistration;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     */
    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

}