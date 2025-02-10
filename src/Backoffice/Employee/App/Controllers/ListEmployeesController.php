<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Employee\Domain\Actions\ListEmployeesAction;

class ListEmployeesController
{
    public function __invoke(
        ListEmployeesAction $listEmployeesAction,
    ): JsonResponse {
        $employees = $listEmployeesAction->execute();

        return response()->json([
            'data' => $employees,
        ], JsonResponse::HTTP_OK);
    }
}
