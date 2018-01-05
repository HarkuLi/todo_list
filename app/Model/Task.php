<?php
namespace Harku\TodoList\Model;

class Task
{
    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function setEndDate(string $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getStatus(): int
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
