<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:35
 */

namespace app\components;

class Urls
{
    public $data;

    function __construct()
    {
        $this->data = [
            'pages' => [
                'default'       => 'Index',
                'index'         => 'Index',
                'admin-movies'  => 'admin\\Movies',
                'admin-login'   => 'admin\\Login',
                'admin-logout'   => 'admin\\Logout'
            ],
        ];
    }
}