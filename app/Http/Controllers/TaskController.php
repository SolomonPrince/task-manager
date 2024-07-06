<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Repositories\Interface\TaskInterface;
use App\Http\Responses\ApiBaseResponse;
use App\Http\Responses\ErrorApiResponse;
use App\Http\Responses\SuccessApiResponse;
use App\Data\TaskData;

class TaskController extends Controller
{

     // Внедрение зависимости репозитория TaskInterface
    public function __construct(
        protected readonly TaskInterface $taskRepo,
    ){}


    // Метод для получения списка задач с возможностью поиска
    public function index(Request $request): ApiBaseResponse
    {
        try{
            // Получение задач с учетом параметров поиска из репозитория
            $tasks = $this->taskRepo->search($request->all());

            // Возврат успешного ответа с данными задач
            return SuccessApiResponse::make(
                TaskData::fromModels($tasks)
            );
        }catch (\Exception $e){
            // Возврат ошибки в случае возникновения исключения
            return ErrorApiResponse::make($e->getMessage());
        }
    }


    // Метод для создания новой задачи
    public function store(TaskRequest $request): ApiBaseResponse
    {
        try{
            // Создание новой задачи с данными из запроса
            $task = $this->taskRepo->create($request->getData());

            // Возврат успешного ответа с данными созданной задачи
            return SuccessApiResponse::make(
                TaskData::fromModel($task)
            );
        }catch (\Exception $e){
            // Возврат ошибки в случае возникновения исключения
            return ErrorApiResponse::make($e->getMessage());
        }
    }


    // Метод для получения данных конкретной задачи
    public function show(Task $task): ApiBaseResponse
    {
        try{
            // Возврат успешного ответа с данными задачи
            return SuccessApiResponse::make(
                TaskData::fromModel($task)
            );
        }catch (\Exception $e){
            // Возврат ошибки в случае возникновения исключения
            return ErrorApiResponse::make($e->getMessage());
        }
    }

    // Метод для обновления данных конкретной задачи
    public function update(TaskRequest $request, Task $task): ApiBaseResponse
    {
        try{
            // Обновление задачи с данными из запроса
            $task = $this->taskRepo->update($task, $request->getData());

            // Возврат успешного ответа с данными обновленной задачи
            return SuccessApiResponse::make(
                TaskData::fromModel($task)
            );
        }catch (\Exception $e){
            // Возврат ошибки в случае возникновения исключения
            return ErrorApiResponse::make($e->getMessage());
        }
    }


    // Метод для удаления конкретной задачи
    public function destroy(Task $task)
    {
        try{
            // Удаление задачи
            $this->taskRepo->delete($task);

            // Возврат успешного ответа с данными удаленной задачи
            return SuccessApiResponse::make(
                TaskData::fromModel($task)
            );
        }catch (\Exception $e){
            // Возврат ошибки в случае возникновения исключения
            return ErrorApiResponse::make($e->getMessage());
        }
    }
}
