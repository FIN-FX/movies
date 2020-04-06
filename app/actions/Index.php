<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:42
 */

namespace app\actions;

use app\components\Route;
use app\components\View;

class Index extends Route
{
    public function run() : void
    {
        $view = new View();
        $view->load("index");
    }
}