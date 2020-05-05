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
		if ( class_exists('dvc\application')) {
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
			new dvc\application( dirname( __DIR__));

		}
		elseif ( class_exists('Parsedown')) {
			/**
			 * Well not that simple - you have extended it with
			 * composer require erusev/parsedown
			 */

			print '<html><body>';
			print Parsedown::instance()->text( file_get_contents( __DIR__ . '/../../Readme.md'));
			print '</body></html>';

		}
		else {

			/**
			 * Yeah - the Minimum Viable Product
			 */
			print 'hello world';

		}

	}

}
