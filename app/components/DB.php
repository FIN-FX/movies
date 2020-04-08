<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 21:48
 */

namespace app\components;

/**
 * Singleton for connection to database
 * @package app\components
 */
class DB
{
    private static $instance;

    protected function __construct() {}

    protected function __clone() {}

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): \PDO
    {
        if (!isset(self::$instance)) {
            $dsn = 'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset='.DB_CHARSET;
            try {
                self::$instance = new \PDO($dsn, DB_USER, DB_PASSWORD);
            } catch (\PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}