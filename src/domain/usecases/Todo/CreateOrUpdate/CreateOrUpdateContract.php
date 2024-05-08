<?php

namespace Domain\UseCases\Todo\CreateOrUpdate;

use Domain\Entities\Todo\TodoData;

/**
 * @author Gustavo Lidani <gustavo@lidani.dev>
 */
interface CreateOrUpdateContract
{
  public function execute(TodoData $data): TodoData;
}
