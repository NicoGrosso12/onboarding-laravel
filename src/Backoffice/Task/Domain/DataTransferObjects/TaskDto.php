<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\DataTransferObjects;

class TaskDto
{
    public function __construct(
        public readonly string|null $id,
        public readonly string $title,
        public readonly string $description,
        public readonly string $status,
        public readonly string $employee_id,
    ) {
    }
}
