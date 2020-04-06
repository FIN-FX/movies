<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 22:46
 */

namespace app\components\admin;

use app\components\Route;

class Auth extends Route
{
    protected function beforeRun(): void
    {
        session_start();
        $hash = $_COOKIE['hash'] ?? '';
        if (empty($hash) || sha1(ADMIN_EMAIL.ADMIN_PASSWORD.session_id()) !== $_COOKIE['hash']) {
            header('Location: '.ADMIN_LOGIN_URL);
            exit;
        }
        self::$isAdmin = true;
    }
}