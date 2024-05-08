<?php

use Adapters\Repositories\TodoRepository;

use Domain\Entities\Todo\TodoData;
use Domain\UseCases\Todo\CreateOrUpdate\CreateOrUpdateTodo;

use External\Laravel\Models\TodoModel;

describe('unit: create or update todo', function () {

  function mockTodoArray()
  {
    return [
      'name' => 'test todo',
      'done' => false,
    ];
  }

  function mockUpdatedTodoArray()
  {
    return [
      'id' => 123,
      'name' => 'updated todo',
      'done' => true,
    ];
  }

  it('should create new todo', function () {
    $data = TodoData::create(mockTodoArray());
    $this->instance(
      TodoModel::class,
      $model = mock(TodoModel::class)
    );

    $model->wasRecentlyCreated = true;
    $model->shouldReceive('query')
      ->once()->andReturnSelf();
    $model->shouldReceive('firstOrCreate')
      ->once()->with(['id' => null], $data->toArray())
      ->andReturnSelf();
    $model->shouldReceive('toArray')
      ->once()->andReturn([...$data->toArray(), 'id' => 123]);

    $usecase = new CreateOrUpdateTodo(new TodoRepository($model));
    $result = $usecase->execute($data);

    expect($result->id)->toBe(123);
    expect($result->name)->toBe('test todo');
    expect($result->done)->toBe(false);
  });

  it('should update existing todo', function () {
    $data = TodoData::create(mockUpdatedTodoArray());
    $this->instance(
      TodoModel::class,
      $model = mock(TodoModel::class)
    );

    $existing = mock(TodoModel::class, mockTodoArray());

    $model->shouldReceive('query')
      ->once()->andReturnSelf();
    $model->shouldReceive('firstOrCreate')
      ->once()->with(['id' => 123], $data->toArray())
      ->andReturn($existing);

    $existing->wasRecentlyCreated = false;
    $existing->shouldReceive('fill')
      ->once()->with($data->toArray())
      ->andReturnSelf();
    $existing->shouldReceive('isDirty')
      ->once()->andReturnTrue();
    $existing->shouldReceive('save')
      ->once()->andReturnSelf();
    $existing->shouldReceive('toArray')
      ->once()->andReturn(mockUpdatedTodoArray());

    $usecase = new CreateOrUpdateTodo(new TodoRepository($model));
    $result = $usecase->execute($data);

    expect($result->id)->toBe(123);
    expect($result->name)->toBe('updated todo');
    expect($result->done)->toBe(true);
  });
});
