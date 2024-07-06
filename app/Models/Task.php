<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель для таблицы tasks
 *
 * === Столбцы ===
 * @property int $id Идентификатор задачи
 * @property string $title Заголовок задачи
 * @property string|null $description Описание задачи (может быть null)
 * @property string $status Статус задачи
 * @property Carbon $deadline Крайний срок выполнения задачи
 * @property Carbon|null $created_at Дата создания задачи (может быть null)
 * @property Carbon|null $updated_at Дата обновления задачи (может быть null)
 */
class Task extends Model
{
    use HasFactory;

     /**
     * Атрибуты, которые можно массово присваивать.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',        // Заголовок задачи
        'description',  // Описание задачи
        'status',       // Статус задачи
        'deadline',     // Крайний срок выполнения задачи
    ];

    /**
     * Атрибуты, которые должны быть приведены к указанным типам.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deadline' => 'datetime',  // Преобразование атрибута deadline в объект Carbon (datetime)
    ];
}
