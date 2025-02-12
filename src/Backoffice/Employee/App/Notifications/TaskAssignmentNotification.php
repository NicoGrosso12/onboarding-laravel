<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Lightit\Backoffice\Employee\Domain\Models\Employee;
use Lightit\Backoffice\Task\Domain\Models\Task;

class TaskAssignmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected Task $task)
    {
    }

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(Employee $employee): MailMessage
    {

        return (new MailMessage())
            ->subject('Task assignment notification')
            ->view(
                'mail.assigned-task',
                [
                    'task' => $this->task,
                    'assignedEmployee' => $employee,
                    'date' => $this->task->created_at->toDateString(),
                ]
            );
    }
}
