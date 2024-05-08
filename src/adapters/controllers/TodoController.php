<?php

namespace Adapters\Controllers;

use Domain\Entities\Todo\TodoData;
use Domain\UseCases\Todo\CreateOrUpdate\CreateOrUpdateContract;
use Domain\UseCases\Todo\GetById\GetByIdContract;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Gustavo Lidani <gustavo@lidani.dev>
 */
class TodoController
{
  public function __construct(
    private GetByIdContract $getTodoById,
    private CreateOrUpdateContract $createOrUpdateTodo,
  ) {
  }

  public function getById(Request $request)
  {
    $data = $request->validate([
      'id' => 'required|int',
    ]);

    return $this->getTodoById->execute($data['id'])?->toArray()
      ?? throw new NotFoundHttpException('todo not found');
  }

  public function createOrUpdateTodo(Request $request)
  {
    $data = $request->validate([
      'id' => 'nullable|int',
      'name' => 'string|required_unless:id,null',
      'done' => 'bool|required_unless:id,null',
    ]);

    return $this->createOrUpdateTodo->execute(TodoData::create($data))->toArray();
  }
}
