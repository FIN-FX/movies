<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 22:47
 */

namespace app\actions\admin;

use app\components\Route;
use app\components\View;

class Login extends Route
{
    public function run() : void
    {
        session_start();
        $error = '';
        $hash = $_COOKIE['hash'] ?? '';
        if (!empty($hash) && sha1(ADMIN_EMAIL.ADMIN_PASSWORD.session_id()) === $_COOKIE['hash']) {
            header('Location: admin-movies');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST['email']) &&
                trim($_POST['email']) === ADMIN_EMAIL &&
                isset($_POST['password']) &&
                sha1(trim($_POST['password'])) === ADMIN_PASSWORD
            ) {
                setcookie("hash", sha1(ADMIN_EMAIL.ADMIN_PASSWORD.session_id()), time()+60*60*24*30, "/", null, null, true);
                header('Location: admin-movies');
                exit;
            } else {
                $error = 'Incorrect email or password';
            }
        }
        $view = new View();
        $view->load("admin/login", [
            'error' => $error,
            'email' => $_POST['email'] ?? ''
        ]);
    }
}