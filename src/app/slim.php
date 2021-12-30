<?php

/**
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
 */

use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

class slim {
	static function run() {
		$app = AppFactory::create();

		$app->get('/', home\controller::class)
			->add(home\auth::class);
		$app->post('/', [home\controller::class, 'postHandler']);

		$app->get('/css[/{file}]', [home\controller::class, 'css']);
		$app->get('/js[/{file}]', [home\controller::class, 'js']);

		// Add Error Middleware
		$errorMiddleware = $app->addErrorMiddleware(true, true, true);
		$errorMiddleware->setDefaultErrorHandler(function (
			Request $request,
			Throwable $exception,
			bool $displayErrorDetails,
			bool $logErrors,
			bool $logErrorDetails
		) use ($app) {
			// ?LoggerInterface $logger = null
			// $logger->error($exception->getMessage());

			$payload = ['error' => $exception->getMessage()];

			$response = $app->getResponseFactory()->createResponse();
			$response->getBody()->write(
				sprintf(
					'<pre>%s</pre>',
					json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
				)
			);

			return $response;
		});

		$app->run();
	}
}
