<?php

namespace External\Laravel\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Gustavo Lidani <gustavo@lidani.dev>
 */
class TodoModel extends Model
{

  /** @inheritdoc */
  protected $table = 'todos';

  /** @inheritdoc */
  protected $fillable = [
    'name',
    'done',
  ];
}
