<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:35
 */

namespace app\components;

/**
 * Main routing config
 * @package app\components
 */
class Urls
{
    public $data;

    function __construct()
    {
        $this->data = [
            'pages' => [
                'default'           => 'Index',
                'index'             => 'Index',
                'details'           => 'Details',
                'order'             => 'Order',
                'admin-login'       => 'admin\\Login',
                'admin-logout'      => 'admin\\Logout',
                'admin-create-movie'   => 'admin\\CreateMovie',
                'admin-update-movie'   => 'admin\\UpdateMovie',
                'admin-delete-movie'   => 'admin\\DeleteMovie'
            ],
        ];
    }
}