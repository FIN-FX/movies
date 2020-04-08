<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 18:13
 */

require_once '../bootstrap.php';
ini_set('display_errors', DEBUG);

$route = new app\components\Route();
$route->init();
