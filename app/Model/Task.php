<?php
namespace Harku\TodoList\Model;

class Task
{
    /**
     * used for converting the array returned by PDO to a Task object
     *
     * @param iterable $assocTask an associative array of task
     */
    public function __construct(iterable $assocTask = null)
    {
        if ($assocTask === null) {
            return;
        }

        $this->id = $assocTask["id"];
        $this->title = $assocTask["title"];
        $this->startDate = $assocTask["start_date"];
        $this->endDate = $assocTask["end_date"];
        $this->status = $assocTask["status"];
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(string $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    private $id;
    private $title;
    private $startDate;
    private $endDate;
    private $status;
}
