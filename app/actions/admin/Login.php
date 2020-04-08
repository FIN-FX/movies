<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 22:47
 */

namespace app\actions\admin;

use app\components\Route;
use app\models\forms\Login as LoginForm;

/**
 * Login action
 * @package app\actions\admin
 */
class Login extends Route
{
    /**
     * Main action process
     */
    public function run() : void
    {
        $form = new LoginForm();
        if (self::$isAdmin) {
            header('Location: /');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($form->login()) {
                header('Location: /');
                exit;
            }
        }
        $this->view->load("admin/login", [
            'error' => $form->error,
            'email' => $_POST['email'] ?? ''
        ]);
    }
}