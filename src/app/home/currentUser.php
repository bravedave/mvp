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

abstract class currentUser {
  protected static $_user = '';
  protected static $_valid = false;

  static function init() {
    session_start();
    if (isset($_SESSION['user'])) {
      self::$_user = $_SESSION['user'];
      self::$_valid = true;
    }

  }

  static function isValid() : bool {
    return self::$_valid;

  }

  static function validate( string $user) : void {
    $_SESSION['user'] = $user;

  }

}

currentUser::init();