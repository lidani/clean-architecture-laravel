<?php

namespace External\Laravel;

use Illuminate\Foundation\Application as FoundationApplication;

class Application extends FoundationApplication
{
  /** @inheritdoc */
  protected $environmentPath = __DIR__ . '/../../../';

  /** @inheritdoc */
  protected $databasePath = __DIR__ . '/database/';

  /** @inheritdoc */
  protected $configPath = __DIR__ . '/config/';
}
