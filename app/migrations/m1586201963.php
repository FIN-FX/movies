<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 22:39
 */

use app\components\DB;

class m1586201963
{
    const TABLE = 'sessions';

    public function run()
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('
            CREATE TABLE IF NOT EXISTS `'.self::TABLE.'` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `hours` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ');
        return $stmt->execute();
    }
}