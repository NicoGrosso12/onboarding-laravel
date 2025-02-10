<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDto;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpsertTaskAction
{
    public function execute(TaskDto $taskDto): Task|null
    {
        if ($taskDto->getId()) {
            $task = Task::find($taskDto->getId());
            if ($task) {
                $task->update([
                    'title' => $taskDto->getTitle(),
                    'description' => $taskDto->getDescription(),
                    'status' => $taskDto->getStatus(),
                    'employee_id' => $taskDto->getEmployeeId(),
                ]);
            }

            return $task;
        } else {
            return Task::create([
                'title' => $taskDto->getTitle(),
                'description' => $taskDto->getDescription(),
                'status' => $taskDto->getStatus(),
                'employee_id' => $taskDto->getEmployeeId(),
            ]);
        }
    }
}
