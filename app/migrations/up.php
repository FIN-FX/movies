<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 22:07
 */

require_once realpath(dirname(__FILE__)).'/../bootstrap.php';

foreach (glob(realpath(dirname(__FILE__)) . '/[!up]*.php') as $filename)
{
    include_once $filename;
    $class = str_replace('.php', '', basename($filename));
    if ((new $class)->run()) {
        echo $class::TABLE . ' table successfully created'.PHP_EOL;
    } else {
        echo $class::TABLE . ' table creation failed'.PHP_EOL;
    }
}