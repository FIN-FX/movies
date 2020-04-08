<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 22:46
 */

namespace app\components\admin;

use app\components\Route;

/**
 * Parent class for admin actions
 * Used to close action from unauthorized users
 * @package app\components\admin
 */
class Auth extends Route
{
    protected function beforeRun(): void
    {
        if (!self::$isAdmin) {
            header('Location: '.ADMIN_LOGIN_URL);
            exit;
        }
    }
}