<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 14:36
 */

namespace app\models\forms;

class Login
{
    protected $email;

    protected $password;

    protected $hash;

    public $error;

    public function __construct()
    {
        session_start();
        $this->hash = $_COOKIE['hash'] ?? '';
        $this->email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $this->password = isset($_POST['password']) ? trim($_POST['password']) : '';
    }

    public function isAuthorized() : bool
    {
        return (!empty($this->hash) && sha1(ADMIN_EMAIL.ADMIN_PASSWORD.session_id()) === $this->hash);
    }

    public function login() : bool
    {
        if ($this->email === ADMIN_EMAIL && sha1(trim($this->password)) === ADMIN_PASSWORD) {
            setcookie("hash", sha1(ADMIN_EMAIL.ADMIN_PASSWORD.session_id()), time()+3600, "/", null, null, true);
            return true;
        } else {
            $this->error = 'Incorrect email or password';
            return false;
        }
    }

    public function logout() : void
    {
        setcookie("hash", sha1(ADMIN_EMAIL.ADMIN_PASSWORD.session_id()), time()-3600, "/", null, null, true);
    }
}