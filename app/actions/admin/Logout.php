<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 01:49
 */

namespace app\actions\admin;

use app\components\admin\Auth;
use app\models\forms\Login as LoginForm;

/**
 * Logout action
 * @package app\actions\admin
 */
class Logout extends Auth
{
    /**
     * Main action process
     */
    public function run() : void
    {
        $form = new LoginForm();
        $form->logout();
        header('Location: ' . ADMIN_LOGIN_URL);
        exit;
    }
}