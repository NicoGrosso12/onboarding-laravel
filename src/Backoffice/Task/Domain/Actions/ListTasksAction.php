<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Illuminate\Database\Eloquent\Collection;
use Lightit\Backoffice\Task\Domain\Models\Task;

class ListTasksAction
{
    /**
     * @return Collection<int, Task>
     */
    public function execute(): Collection
    {
        return Task::all();
    }
}
