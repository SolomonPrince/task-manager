<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapOutputName;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskData extends Data
{
    /**
     * Конструктор класса TaskData
     * 
     * @param int|null $id Идентификатор задачи
     * @param string $title Заголовок задачи
     * @param string|null $description Описание задачи
     * @param string $status Статус задачи
     * @param string $deadline Крайний срок выполнения задачи
     * @param string|null $createdAt Дата создания задачи
     */

    public function __construct(
      public ?int $id,
      public string $title,
      public ?string $description,
      public string $status,
      public string $deadline,
      #[MapOutputName('created_at')]
      #[MapInputName('created_at')]
      public ?string $createdAt
    ) {}


    /**
     * Создание экземпляра TaskData из модели Task
     *
     * @param Task $task Экземпляр модели Task
     * @return self
     */
    public static function fromModel(Task $task): self
    {
        // Возвращает новый экземпляр TaskData с данными из модели Task
        return new self(
            $task->id,
            $task->title,
            $task->description,
            $task->status,
            $task->deadline->format('Y-m-d\TH:i:s.u\Z'),
            $task->created_at->format('Y-m-d\TH:i:s.u\Z'),
        );
    }


    /**
     * Создание коллекции экземпляров TaskData из коллекции моделей Task
     *
     * @param Collection $tasks Коллекция моделей Task
     * @return Collection
     */
    public static function fromModels(Collection $tasks): Collection
    {
        // Возвращает коллекцию TaskData, преобразуя каждую модель Task в TaskData
        return $tasks->map(fn (Task $task) => self::fromModel($task));
    }
}
