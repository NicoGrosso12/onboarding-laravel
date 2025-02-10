<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Task\Domain\Actions\ListTasksAction;

class ListTasksController
{
    public function __invoke(
        ListTasksAction $listTasksAction,
    ): JsonResponse {
        $tasks = $listTasksAction->execute();

        return response()->json([
            'data' => $tasks,
        ], JsonResponse::HTTP_OK);
    }
}
