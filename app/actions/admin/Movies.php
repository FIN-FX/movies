<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 22:47
 */

namespace app\actions\admin;

use app\components\admin\Auth;
use app\components\View;

class Movies extends Auth
{
    public function run() : void
    {
        $view = new View();
        $view->load("admin/movies");
    }
}