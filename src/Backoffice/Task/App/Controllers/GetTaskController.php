<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Task\App\Transformers\TaskTransformer;
use Lightit\Backoffice\Task\Domain\Actions\GetTaskAction;

class GetTaskController
{
    public function __invoke(
        GetTaskAction $getTaskAction,
        int $taskId,
    ): JsonResponse {
        $task = $getTaskAction->execute($taskId);

        if (! $task) {
            return response()->json(['error' => 'Task not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return responder()->success($task, TaskTransformer::class)->respond(JsonResponse::HTTP_OK);
    }
}
