<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Task\App\Transformers\TaskTransformer;
use Lightit\Backoffice\Task\Domain\Models\Task;

class GetTaskController
{
    public function __invoke(Task $task): JsonResponse
    {

        return responder()
            ->success($task, TaskTransformer::class)
            ->respond();
    }
}
