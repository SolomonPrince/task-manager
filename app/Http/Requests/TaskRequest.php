<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;
use App\Data\TaskData;

class TaskRequest extends FormRequest
{
    use WithData;

    /**
     * Определяет, авторизован ли пользователь для выполнения этого запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Разрешает выполнение запроса для всех пользователей
        return true;
    }

    /**
     * Возвращает правила валидации, применяемые к запросу.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         // Правила валидации для полей запроса
         return [
            'title' => ['required', 'string', 'max:255'], // Заголовок: обязательное поле, строка, макс. длина 255 символов
            'description' => ['nullable', 'string'], // Описание: необязательное поле, строка
            'status' => ['required', 'in:pending,in_progress,completed'], // Статус: обязательное поле, одно из заданных значений
            'deadline' => ['required', 'date'], // Крайний срок: обязательное поле, дата
        ];
    }


    /**
     * Возвращает класс данных, используемый для этого запроса.
     *
     * @return string
     */
    protected function dataClass(): string
    {
        // Указывает, что для этого запроса будет использоваться TaskData
        return TaskData::class;
    }

}
