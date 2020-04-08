<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:42
 */

namespace app\actions;

use app\components\Route;
use app\models\Movie;
use app\models\Session;

class Details extends Route
{
    public function run($id) : void
    {
        $model = Movie::findById($id);
        $sessions = Session::findAll();
        $this->view->load("details", [
            'model' => $model,
            'sessions' => $sessions
        ]);
    }
}