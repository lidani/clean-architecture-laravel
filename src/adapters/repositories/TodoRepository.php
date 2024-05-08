<?php

namespace Adapters\Repositories;

use Domain\Entities\Todo\TodoData;
use Domain\Ports\TodoRepositoryContract;

use External\Laravel\Models\TodoModel;

/**
 * @author Gustavo Lidani <gustavo@lidani.dev>
 */
class TodoRepository implements TodoRepositoryContract
{
  public function __construct(
    private TodoModel $model
  ) {
  }

  public function getById(int $id): ?TodoData
  {
    $result = $this->model::query()->where('id', $id)->first();
    return TodoData::create($result?->toArray());
  }

  public function createOrUpdate(TodoData $todo): TodoData
  {
    $result = $this->model::query()->firstOrCreate(['id' => $todo->id], $data = $todo->toArray());

    if (!$result->wasRecentlyCreated) {
      $result->fill($data)->isDirty() && $result->save();
    }

    return TodoData::create($result->toArray());
  }
}
