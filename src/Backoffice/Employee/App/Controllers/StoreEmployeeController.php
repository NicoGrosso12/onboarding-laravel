<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Lightit\Backoffice\Employee\App\Request\StoreEmployeeRequest;
use Lightit\Backoffice\Employee\App\Transformers\EmployeeTransformer;
use Lightit\Backoffice\Employee\Domain\Actions\StoreEmployeesAction;

class StoreEmployeeController extends Controller
{
    public function __invoke(
        StoreEmployeesAction $storeEmployeesAction,
        StoreEmployeeRequest $request,
    ): JsonResponse {
        $employee = $storeEmployeesAction->execute($request->toDto());

        return responder()
            ->success($employee, EmployeeTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
