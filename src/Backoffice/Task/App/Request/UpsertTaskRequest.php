<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Request;

use Illuminate\Foundation\Http\FormRequest;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDto;

class UpsertTaskRequest extends FormRequest
{
    public const ACTION = 'action';

    public const ID = 'id';

    public const TITLE = 'title';

    public const DESCRIPTION = 'description';

    public const STATUS = 'status';

    public const EMPLOYEE_ID = 'employee_id';

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            self::ACTION => ['required', 'in:create,update'],
            self::ID => ['nullable', 'exists:tasks,id'],
            self::TITLE => ['required'],
            self::DESCRIPTION => ['required'],
            self::STATUS => ['required'],
            self::EMPLOYEE_ID => ['required'],
        ];
    }

    public function toDto(): TaskDto
    {
        $isCreate = $this->string(self::ACTION)->toString() === 'create';

        return new TaskDto(
            id: $isCreate ? null : ($this->filled(self::ID) ? $this->string(self::ID)->toString() : null),
            title: $this->string(self::TITLE)->toString(),
            description: $this->string(self::DESCRIPTION)->toString(),
            status: $this->string(self::STATUS)->toString(),
            employee_id: $this->string(self::EMPLOYEE_ID)->toString(),
        );
    }
}
