<?php

namespace Domain\Ports;

use Domain\Entities\Todo\TodoData;
use External\Laravel\Models\TodoModel;

/**
 * @author Gustavo Lidani <gustavo@lidani.dev>
 */
interface TodoRepositoryContract
{
  public function __construct(TodoModel $model);
  public function getById(int $id): ?TodoData;
  public function createOrUpdate(TodoData $todo): TodoData;
}
