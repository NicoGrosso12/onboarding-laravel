<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\DataTransferObjects;

class TaskDto
{
    public function __construct(
        private readonly string|null $id,
        private readonly string $title,
        private readonly string $description,
        private readonly string $status,
        private readonly string $employee_id,
    ) {
    }

    public function getId(): int|null
    {
        return $this->id !== null ? (int) $this->id : null;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getEmployeeId(): string
    {
        return $this->employee_id;
    }
}
