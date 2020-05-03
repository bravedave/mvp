<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

if ( class_exists('dvc\application')) {
	class application extends dvc\application {
		static function run() {
			/*
			 * Extended example, uses an application directory structure
			 *
			 * To use this example, install bravedave/dvc
			 * 	composer require bravedave/dvc
			 *
			 * then review the folders
			 * 	controller
			 *  app
			 */
			new self( __DIR__);

		}

	}

}
else {
	class application {
		static function run() {
			if ( class_exists('Parsedown')) {
				print '<html><body>';
				print Parsedown::instance()->text( file_get_contents( __DIR__ . '/../Readme.md'));
				print '</body></html>';

			}
			else {
				print 'hello world';

			}

		}

	}

}

