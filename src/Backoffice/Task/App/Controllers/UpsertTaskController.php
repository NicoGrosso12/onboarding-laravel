<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Task\App\Request\UpsertTaskRequest;
use Lightit\Backoffice\Task\App\Transformers\TaskTransformer;
use Lightit\Backoffice\Task\Domain\Actions\UpsertTaskAction;

class UpsertTaskController
{
    public function __invoke(
        UpsertTaskAction $upsertTaskAction,
        UpsertTaskRequest $request,
    ): JsonResponse {
        $task = $upsertTaskAction->execute($request->toDto());

        return responder()
            ->success($task, TaskTransformer::class)
            ->respond();
    }
}
