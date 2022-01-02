<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

class config {
  static public function dataPath(): string {
    $path = realpath(__DIR__ . '/../') . '/data';

    // error_log( sprintf('<%s> %s', $path, __METHOD__));

    if (!is_dir($path)) {
      mkdir($path);
      chmod($path, 0x777);
    }

    if (!file_exists($ignore = $path . DIRECTORY_SEPARATOR . '.gitignore')) {
      file_put_contents($ignore, '*' . PHP_EOL);
    }

    if (!file_exists($readme = $path . DIRECTORY_SEPARATOR . 'readme.txt')) {
      file_put_contents($readme, implode(PHP_EOL, [
        '-----------',
        'data Folder',
        '-----------',
        '',
        'keep this folder private',
        '',
        '--------------------------------------------',
        '*-* DO NOT UPLOAD TO A PUBLIC REPOSITORY *-*',
        '--------------------------------------------'

      ]));
    }

    return $path;
  }
}
