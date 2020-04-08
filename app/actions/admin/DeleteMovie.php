<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 16:18
 */

namespace app\actions\admin;

use app\components\admin\Auth;
use app\models\Movie;

class DeleteMovie extends Auth
{
    public function run($id) : void
    {
        Movie::deleteById($id);
        header('Location: /');
        exit;
    }
}