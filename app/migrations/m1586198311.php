<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 21:38
 */

use app\components\DB;

class m1586198311
{
    const TABLE = 'movies';

    public function run()
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('
            CREATE TABLE IF NOT EXISTS `'.self::TABLE.'` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `title` varchar(100) NOT NULL,
              `description` varchar(255) DEFAULT \'\',
              `poster` longtext,
              `created_at` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ');
        return $stmt->execute();
    }
}