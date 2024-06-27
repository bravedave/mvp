<?php

/**
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
 */

class launcher {
	static function run() {

		if ('cli-server' == php_sapi_name()) {

			if ('localhost' == $_SERVER['SERVER_NAME']) {

				$origin = sprintf('http://%s:%s', $_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']);
				/**
				 * you probably have to set it to this
				 * the issue is that some requests will use 127.0.0.1
				 * (probably the fonts from the css files)
				 * others will use localhost
				 *
				 * this should only activate for the cli server
				 */
				$origin = '*';
				header("Access-Control-Allow-Origin: $origin");
				header("Access-Control-Allow-Credentials: true");
				header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Accept');
			}
		}

		if (class_exists('dvc\application')) {

			/**
			 * Extended example, uses an application directory structure
			 *
			 * To use this example, install bravedave/dvc
			 * 	composer require bravedave/dvc
			 *
			 * then review the folders
			 *  controller
			 *  app
			 */
			application::run();
		} elseif (class_exists('Slim\Factory\AppFactory')) {

			slim::run();
		} elseif (class_exists('pages\page')) {

			/**
			 * use the tutorial from https://github.com/bravedave/pages
			 * to activate this extension
			 */
			$page = new pages\page;  // from outside this namespace
			$page->open();

			print Parsedown::instance()->text(file_get_contents(__DIR__ . '/../../Readme.md'));
		} elseif (class_exists('Parsedown')) {

			/**
			 * Well not that simple - you have extended it with
			 * composer require erusev/parsedown
			 */
			$template = file_get_contents(__DIR__ . '/template/parsedown.html');

			print str_replace([
				'{title}',
				'{markdown}'
			], [
				'ParseDown Demo',
				Parsedown::instance()
					->text(file_get_contents(__DIR__ . '/../../Readme.md'))
			], $template);
		} else {

			/* Yeah - the Minimum Viable Product */
			header('Content-Type: text/plain');
			print 'see https://github.com/bravedave/mvp';
		}
	}
}
