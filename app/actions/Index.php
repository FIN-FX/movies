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

class Index extends Route
{
    public function run() : void
    {
        $popular = Movie::findPopular();
        $models = Movie::findAll();
        $this->view->load("index", [
            'popular' => $popular,
            'models' => $models
        ]);
    }
}