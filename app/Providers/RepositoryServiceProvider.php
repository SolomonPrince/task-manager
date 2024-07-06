<?php

namespace App\Providers;

use App\Repositories\TaskRepository;
use App\Repositories\Interface\TaskInterface;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TaskInterface::class, TaskRepository::class);
    }
}
