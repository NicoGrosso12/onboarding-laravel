<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Notification;
use Lightit\Backoffice\Employee\App\Notifications\TaskAssignmentNotifications;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDto;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpsertTaskAction
{
    public function execute(TaskDto $taskDto): Task
    {
        if ($taskDto->getId()) {
            $task = Task::find($taskDto->getId());
            if ($task) {
                $oldEmployeeId = $task->employee_id;

                $task->update([
                    'title' => $taskDto->getTitle(),
                    'description' => $taskDto->getDescription(),
                    'status' => $taskDto->getStatus(),
                    'employee_id' => $taskDto->getEmployeeId(),
                ]);

                if ($task->employee_id !== $oldEmployeeId) {
                    $assignedEmployee = $task->employee;
                    Notification::send($assignedEmployee, new TaskAssignmentNotifications($task));
                }

                return $task;
            }

            throw new ModelNotFoundException('Task not found');
        } else {
            $task = Task::create([
                'title' => $taskDto->getTitle(),
                'description' => $taskDto->getDescription(),
                'status' => $taskDto->getStatus(),
                'employee_id' => $taskDto->getEmployeeId(),
            ]);

            $assignedEmployee = $task->employee;
            Notification::send($assignedEmployee, new TaskAssignmentNotifications($task));

            return $task;
        }
    }
}
