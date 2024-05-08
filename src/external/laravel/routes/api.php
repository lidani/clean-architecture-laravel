<?php

use Adapters\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => 'ping');

Route::prefix('/todos')->group(function () {
  Route::get('/{id}', [TodoController::class, 'getById']);
  Route::post('/{id?}', [TodoController::class, 'createOrUpdateTodo']);
});
