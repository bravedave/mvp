<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/

use Composer\Script\Event;

abstract class twofactor {

  static function demo(Event $event) {

    $tfaFile = __DIR__ . '/data/two-factor-secret';

    echo "twofactor demo\n";
    echo "==============\n";
    if (class_exists('RobThree\Auth\TwoFactorAuth')) {

      $args = [];
      foreach ($event->getArguments() as $arg) {

        $a = explode('=', $arg);
        $args[$a[0]] = $a[1] ?? null;
      }

      $tfa = new RobThree\Auth\TwoFactorAuth;
      if (file_exists($tfaFile)) {

        $secret = file_get_contents($tfaFile);
        if ($code = ($args['code'] ?? false)) {

          $ok = $tfa->verifyCode($secret, $code);
          echo $ok ?  "success\n" : "fail\n";
        } else {

          echo "what's the code ?\n";
        }
      } else {

        $secret = $tfa->createSecret();
        file_put_contents($tfaFile, $secret);

        echo "enter the following code in your app: $secret\n";
        echo "\n\n\n";
      }
    } else {

      echo "requires robthree/twofactorauth\n\n";
      echo "install with:\n composer require robthree/twofactorauth\n\n";
    }
  }
}
