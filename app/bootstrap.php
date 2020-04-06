<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:42
 */

define('DIR', realpath(dirname(__FILE__)));
define('VIEWS', DIR.'/views');

include_once(DIR . '/config/main.php');

function loadClasses($className)
{
    $path = str_replace('\\', '/', $className).'.php';
    include_once(DIR.'/../'.$path);
}

spl_autoload_register('loadClasses');