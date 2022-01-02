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

use config;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;

class controller {
  public function __invoke(Request $request, Response $response, $args) {
    $renderer = new PhpRenderer(__DIR__ . '/views', [
      'title' => 'Hello World',
    ]);

    return $renderer->render($response, "home.phtml", [
      'args' => $args,
      'params' => $request->getQueryParams(),
    ]);
  }

  function css(Request $request, Response $response, $args) {
    // http://localhost:1696/css/fonts/bootstrap-icons.woff?30af91bf14e37666a085fb8a161ff36d
    if ($file = $args['file'] ?? '') {
      $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
      $vendorDir = dirname(dirname($reflection->getFileName()));

      if ('bootstrap.min.css' == $file) {
        if ($path = realpath($vendorDir . '/twbs/bootstrap/dist/css/' . $file)) {
          $response
            ->withHeader('content-type', 'text/css')
            ->getBody()->write(file_get_contents($path));
        }
      } elseif ('bootstrap-icons.css' == $file) {

        if ($path = realpath($vendorDir . '/twbs/bootstrap-icons/font/' . $file)) {
          $response
            ->withHeader('content-type', 'text/css')
            ->getBody()->write(file_get_contents($path));
        }
      } elseif (in_array($file, [
        'bootstrap-icons.woff',
        'bootstrap-icons.woff2'
      ])) {

        if ($path = realpath($vendorDir . '/twbs/bootstrap-icons/font/fonts/' . $file)) {
          $response
            ->withHeader('content-type', 'application/font-woff')
            ->getBody()->write(file_get_contents($path));
        }
      } else {
        error_log(sprintf('<%s> %s', $file, __METHOD__));
      }
    } else {
      error_log(sprintf('<%s> %s', print_r($args), __METHOD__));
    }

    return $response;
  }

  public function js(Request $request, Response $response, $args) {

    if ($file = $args['file'] ?? '') {
      if ('bootstrap.min.js' == $file) {
        $reflection = new \ReflectionClass(\Composer\Autoload\ClassLoader::class);
        $vendorDir = dirname(dirname($reflection->getFileName()));

        // $path = realpath($vendorDir . '/twbs/bootstrap/dist/');
        $path = realpath($vendorDir . '/twbs/bootstrap/dist/js/' . $file);
        // $response = new Response;
        $response
          ->withHeader('content-type', 'text/css')
          ->getBody()->write(file_get_contents($path));
      } elseif ('jquery.min.js' == $file) {
        $tmpfile = implode(DIRECTORY_SEPARATOR, [
          config::dataPath(),
          'jquery.min.js'
        ]);

        if (!file_exists($tmpfile)) {
          file_put_contents(
            $tmpfile,
            file_get_contents('https://code.jquery.com/jquery-3.6.0.min.js')
          );
        }

        if (file_exists($tmpfile)) {
          $response
            ->withHeader('content-type', 'text/javascript')
            ->getBody()->write(file_get_contents($tmpfile));
        }
      }
    }

    return $response;
  }

  public function postHandler(Request $request, Response $response, $args) {
    $params = (array)$request->getParsedBody();
    $action = $params['action'] ?? '';

    $nak = function () use ($action, $response) {
      return $response
        ->withHeader('content-type', 'application/json')
        ->getBody()->write(json_encode([
          'response' => 'nak',
          'description' => $action
        ]));
    };

    if ($action) {
      if ('logon' == $action) {
        if ($user = $params['user'] ?? '' && $pass = $params['pass'] ?? '') {
          currentUser::validate($user);
          $response
            ->getBody()->write(json_encode([
              'response' => 'ack',
              'description' => $action
            ]));
          $response->withHeader('Content-Type', 'application/json');
        } else {
          $response = $nak();
        }
      } else {
        $response = $nak();
      }
    } else {
      $response = $nak();
    }

    return $response;
  }
}
