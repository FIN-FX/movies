<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 16:18
 */

namespace app\actions\admin;

use app\components\admin\Auth;
use app\models\forms\Movie as MovieForm;

/**
 * Action for creation new movie
 * @package app\actions\admin
 */
class CreateMovie extends Auth
{
    /**
     * Main action process
     */
    public function run() : void
    {
        $form = new MovieForm();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($form->load($_POST) && $form->validate() && $form->save()) {
                header('Location: /');
            }
        }
        $this->view->load("admin/create-movie", [
            'form' => $form
        ]);
    }
}