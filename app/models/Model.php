<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 08.04.2020
 * Time: 02:14
 */

namespace app\models;

/**
 * Main model
 * @package app\models
 */
class Model
{
    /**
     * Model validation error
     * @var string
     */
    public $error;

    /**
     * Loading params from array to attributes
     * @param array $params
     * @return bool
     */
    public function load(array $params) : bool
    {
        foreach ($params as $key => $param) {
            $this->$key = $param;
        }
        return true;
    }
}