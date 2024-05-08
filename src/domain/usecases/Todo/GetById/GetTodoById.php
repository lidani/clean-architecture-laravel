<?php

namespace Domain\UseCases\Todo\GetById;

use Domain\Entities\Todo\TodoData;
use Domain\Ports\TodoRepositoryContract;

/**
 * @author Gustavo Lidani <gustavo@lidani.dev>
 */
class GetTodoById implements GetByIdContract
{
  public function __construct(
    private TodoRepositoryContract $repository
  ) {
  }

  public function execute(int $id): TodoData
  {
    return $this->repository->getById($id);
  }
}
