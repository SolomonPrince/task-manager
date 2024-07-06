<?php

namespace App\Repositories\Interface;

use App\Data\TaskData;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskInterface
{
    /**
     * Создает новую задачу.
     *
     * @param TaskData $taskDto Данные задачи (DTO)
     * @return Task Возвращает созданную задачу
     */
    public function create(TaskData $taskDto): Task;

    /**
     * Обновляет существующую задачу.
     *
     * @param Task $task Экземпляр задачи, которая будет обновлена
     * @param TaskData $taskDto Новые данные задачи (DTO)
     * @return Task Возвращает обновленную задачу
     */
    public function update(Task $task, TaskData $taskDto): Task;

    /**
     * Ищет задачи на основе данных фильтра.
     *
     * @param array $filterData Данные фильтра (например, статус, крайний срок)
     * @return Collection Возвращает коллекцию найденных задач
     */
    public function search(array $filterData): Collection;

   
    /**
     * Удаляет существующую задачу.
     *
     * @param Task $task Экземпляр задачи, которая будет удалена
     * @return bool Возвращает true, если задача успешно удалена, иначе false
     */
    public function delete(Task $task): bool;
}

