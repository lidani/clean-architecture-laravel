<?php

namespace Domain\Entities\Todo;

use Domain\Entities\BaseEntity;

/**
 * @author Gustavo Lidani <gustavo@lidani.dev>
 */
class TodoData extends BaseEntity
{
  public function __construct(
    public readonly string $name,
    public readonly bool $done,
    public readonly ?int $id = null,
    public readonly ?string $updated_at = null,
    public readonly ?string $created_at = null,
  ) {
  }
}
