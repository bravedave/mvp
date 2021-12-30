<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

namespace home;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Slim\Views\PhpRenderer;

class auth {
  public function __invoke(Request $request, RequestHandler $handler): Response {
    if (currentUser::isValid()) {
      return $handler->handle($request);

    } else {
      $renderer = new PhpRenderer(__DIR__ . '/views', [
        'title' => 'Logon',
      ]);

      $response = new Response;
      $response->withHeader('Content-Type', 'text/html');

      error_log('logon');

      return $renderer->render($response, "logon.phtml");
    }
  }
}
