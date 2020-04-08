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

class Logout extends Auth
{
    public function run() : void
    {
        $form = new LoginForm();
        $form->logout();
        header('Location: ' . ADMIN_LOGIN_URL);
        exit;
    }
}