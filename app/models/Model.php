<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 08.04.2020
 * Time: 02:14
 */

namespace app\models;

class Model
{
    public $error;

    public function load($params) : bool
    {
        foreach ($params as $key => $param) {
            $this->$key = $param;
        }
        return true;
    }
}