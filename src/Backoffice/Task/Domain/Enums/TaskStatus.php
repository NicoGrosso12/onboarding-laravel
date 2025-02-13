<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Enums;

enum TaskStatus: string
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';
}
