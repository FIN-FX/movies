<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:36
 */

namespace app\components;

/**
 * Component for rendering content from actions
 * @package app\components
 */
class View
{
    public function load($name, $params = []) : void
    {
        $path = VIEWS . "/$name.php";
        if (!file_exists($path)) {
            $data = new Urls();
            $path = VIEWS . '/' . $data->data["pages"]["default"].".php";
        }
        extract($params);
        ob_start();
        include_once($path);
        $content = ob_get_contents();
        ob_end_clean();
        require_once(VIEWS . '/layout.php');
    }
}