<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Notification;
use Lightit\Backoffice\Employee\App\Notifications\TaskAssignmentNotification;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDto;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpsertTaskAction
{
    public function execute(TaskDto $taskDto): Task
    {
        if ($taskDto->id) {
            $task = Task::find($taskDto->id);
            if ($task) {
                $oldEmployeeId = $task->employee_id;

                $task->update([
                    'title' => $taskDto->title,
                    'description' => $taskDto->description,
                    'status' => $taskDto->status,
                    'employee_id' => $taskDto->employee_id,
                ]);

                if ($task->employee_id !== $oldEmployeeId) {
                    $assignedEmployee = $task->employee;
                    Notification::send($assignedEmployee, new TaskAssignmentNotification($task));
                }

                return $task;
            }

            throw new ModelNotFoundException('Task not found');
        } else {
            $task = Task::create([
                'title' => $taskDto->title,
                'description' => $taskDto->description,
                'status' => $taskDto->status,
                'employee_id' => $taskDto->employee_id,
            ]);

            $assignedEmployee = $task->employee;
            Notification::send($assignedEmployee, new TaskAssignmentNotification($task));

            return $task;
        }
    }
}
