<?php

namespace Domain\UseCases\Todo\GetById;

use Domain\Entities\Todo\TodoData;

/**
 * @author Gustavo Lidani <gustavo@lidani.dev>
 */
interface GetByIdContract
{
  public function execute(int $id): ?TodoData;
}
