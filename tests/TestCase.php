<?php

namespace Tests;

use Illuminate\Foundation\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
  /** @inheritdoc */
  public function createApplication()
  {
    $app = require __DIR__ . '/../src/external/laravel/bootstrap/app.php';
    $app->make(Kernel::class)->bootstrap();
    return $app;
  }
}
