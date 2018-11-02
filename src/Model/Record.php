<?php

namespace TrackMe\Model;


final class Record
{
    public const CREATED_AT_FORMAT = 'Y-m-d H:i:s';

    /**
     * @var string
     */
    private $timeSpent;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * Record constructor.
     *
     * @param string $timeSpent
     * @param string $description
     */
    public function __construct(string $timeSpent, string $description)
    {
        $this->timeSpent    = $timeSpent;
        $this->description  = $description;
        $this->createdAt    = (new \DateTime('now'))->format(self::CREATED_AT_FORMAT);
    }

    /**
     * @return string
     */
    public function getTimeSpent(): string
    {
        return $this->timeSpent;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}