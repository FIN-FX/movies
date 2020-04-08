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

/**
 * Action for removing movie with current identifier
 * @package app\actions\admin
 */
class DeleteMovie extends Auth
{
    /**
     * Main action process
     * @param integer $id
     */
    public function run($id) : void
    {
        Movie::deleteById($id);
        header('Location: /');
        exit;
    }
}