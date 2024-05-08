<?php

namespace Domain\UseCases\Todo\CreateOrUpdate;

use Domain\Entities\Todo\TodoData;
use Domain\Ports\TodoRepositoryContract;

/**
 * @author Gustavo Lidani <gustavo@lidani.dev>
 */
class CreateOrUpdateTodo implements CreateOrUpdateContract
{
  public function __construct(
    private TodoRepositoryContract $repository
  ) {
  }

  public function execute(TodoData $data): TodoData
  {
    return $this->repository->createOrUpdate($data);
  }
}
