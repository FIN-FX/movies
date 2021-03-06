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
 * Action for updating movie with current identifier
 * @package app\actions\admin
 */
class UpdateMovie extends Auth
{
    /**
     * Main action process
     * @param integer $id
     */
    public function run($id) : void
    {
        $form = MovieForm::findById($id);
        if (!$form) {
            header('Location: /');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($form->load($_POST) && $form->validate() && $form->save()) {
                header('Location: /details?id='.$id);
                exit;
            }
        }
        $this->view->load("admin/create-movie", [
            'form' => $form
        ]);
    }
}