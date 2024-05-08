<?php

namespace Domain\Entities;

/**
 * @author Gustavo Lidani <gustavo@lidani.dev>
 */
abstract class BaseEntity
{
  public static function create(?array $data)
  {
    if ($data === null) return null;
    return new static(...$data);
  }

  public function toClearArray()
  {
    return array_values(array_filter($this->toArray(), fn ($it) => !is_null($it)));
  }

  public function toArray()
  {
    return (array) $this;
  }
}
