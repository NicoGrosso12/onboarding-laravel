<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Lightit\Backoffice\Task\Domain\Models\Task;

class TaskTransformer extends Transformer
{
    public function transform(Task $task): array
    {
        return [
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status,
            'employee_id' => $task->employee_id,
        ];
    }
}
