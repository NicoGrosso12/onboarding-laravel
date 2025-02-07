<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\Domain\Actions;

use Lightit\Backoffice\Employee\Domain\DataTransferObjects\EmployeeDto;
use Lightit\Backoffice\Employee\Domain\Models\Employee;

class StoreEmployeesAction
{
    public function execute(EmployeeDto $employeeDto): Employee
    {
        $employee = new Employee([
            'name' => $employeeDto->getName(),
            'email' => $employeeDto->getEmail(),
        ]);

        $employee->save();

        return $employee;
    }
}
