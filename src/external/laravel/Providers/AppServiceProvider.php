<?php

namespace External\Laravel\Providers;

use Adapters\Controllers\TodoController;
use Illuminate\Support\ServiceProvider;

use Adapters\Repositories\TodoRepository;

use Domain\UseCases\Todo\CreateOrUpdate\CreateOrUpdateContract;
use Domain\UseCases\Todo\CreateOrUpdate\CreateOrUpdateTodo;
use Domain\UseCases\Todo\GetById\GetByIdContract;
use Domain\UseCases\Todo\GetById\GetTodoById;
use External\Laravel\Models\TodoModel;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $todoRepository = new TodoRepository(new TodoModel);

    $this->app->when(TodoController::class)
      ->needs(CreateOrUpdateContract::class)
      ->give(fn () => new CreateOrUpdateTodo(
        $todoRepository,
      ));

    $this->app->when(TodoController::class)
      ->needs(GetByIdContract::class)
      ->give(fn () => new GetTodoById(
        $todoRepository,
      ));
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
  }
}
