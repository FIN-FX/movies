<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 01:49
 */

namespace app\actions\admin;

use app\components\admin\Auth;

class Logout extends Auth
{
    public function run() : void
    {
        setcookie("hash", sha1(ADMIN_EMAIL.ADMIN_PASSWORD.session_id()), time()-60*60*24*30, "/", null, null, true);
        header('Location: ' . ADMIN_LOGIN_URL);
        exit;
    }
}