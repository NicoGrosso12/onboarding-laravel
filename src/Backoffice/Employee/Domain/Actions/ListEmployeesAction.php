<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\Domain\Actions;

use Illuminate\Database\Eloquent\Collection;
use Lightit\Backoffice\Employee\Domain\Models\Employee;

class ListEmployeesAction
{
    /**
     * @return Collection<int, Employee>
     */
    public function execute(): Collection
    {
        return Employee::all();
    }
}
