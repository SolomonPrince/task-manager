<?php

namespace App\Repositories;

use App\Repositories\Interface\TaskInterface;
use App\Data\TaskData;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

readonly class TaskRepository implements TaskInterface
{
    /**
     * Конструктор TaskRepository.
     *
     * @param Task $model Экземпляр модели Task
     */
    public function __construct(
        protected Task $model
    ){}



    /**
     * Создание новой задачи.
     *
     * @param TaskData $taskDto Данные задачи (DTO)
     * @return Task Возвращает созданную задачу
     */
    public function create(TaskData $taskDto): Task
    {
        // Создание новой задачи с использованием данных из DTO
        return $this->model->create([
            'title' => $taskDto->title,
            'description' => $taskDto->description,
            'status' => $taskDto->status,
            'deadline' => $taskDto->deadline,
        ]);
    }

    /**
     * Обновление существующей задачи.
     *
     * @param Task $task Экземпляр задачи, которая будет обновлена
     * @param TaskData $taskDto Новые данные задачи (DTO)
     * @return Task Возвращает обновленную задачу
     */
    public function update(Task $task, TaskData $taskDto): Task
    {
        // Обновление задачи с использованием данных из DTO
        return tap($task)->update([
            'title' => $taskDto->title,
            'description' => $taskDto->description,
            'status' => $taskDto->status,
            'deadline' => $taskDto->deadline,
        ]);
    }

    /**
     * Поиск задач на основе данных фильтра.
     *
     * @param array $filterData Данные фильтра (например, статус, крайний срок)
     * @return Collection Возвращает коллекцию найденных задач
     */
    public function search(array $filterData): Collection
    {
        // Создание запроса для поиска задач
        $query = $this->model->query();

        // Фильтрация по статусу
        if (isset($filterData['status']) && in_array($filterData['status'], ['pending', 'in_progress', 'completed'])) {
            $query->where('status', $filterData['status']);
        }

        // Фильтрация по крайнему сроку
        if (isset($filterData['due_date'])) {
            $query->whereDate('due_date', $filterData['due_date']);
        }

        // Выполнение запроса и возврат коллекции найденных задач
        return $query->get();
    }

   
    /**
     * Удаление существующей задачи.
     *
     * @param Task $task Экземпляр задачи, которая будет удалена
     * @return bool Возвращает true, если задача успешно удалена, иначе false
     */
    public function delete(Task $task): bool
    {
        // Удаление задачи и возврат результата операции
        return $task->delete();
    }
}