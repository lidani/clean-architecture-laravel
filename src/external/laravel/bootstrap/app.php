<?php

use External\Laravel\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$exceptions = function (Exceptions $exceptions) {
  $exceptions->render(
    fn (NotFoundHttpException $e, Request $request) => response()->json(
      ['message' => $e->getMessage()],
      status: 404
    )
  );
};

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    api: __DIR__ . '/../routes/api.php',
    apiPrefix: '',
  )
  ->withExceptions($exceptions(...))
  ->withMiddleware()
  ->create();
