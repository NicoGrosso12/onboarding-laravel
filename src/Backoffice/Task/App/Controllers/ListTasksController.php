<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Task\App\Transformers\TaskTransformer;
use Lightit\Backoffice\Task\Domain\Actions\ListTasksAction;

class ListTasksController
{
    public function __invoke(
        ListTasksAction $listTasksAction,
    ): JsonResponse {
        $tasks = $listTasksAction->execute();

        return responder()
            ->success($tasks, TaskTransformer::class)
            ->respond();
    }
}
