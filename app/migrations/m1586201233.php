<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 22:27
 */

use app\components\DB;

class m1586201233
{
    const TABLE = 'clients';

    public function run()
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('
            CREATE TABLE IF NOT EXISTS `'.self::TABLE.'` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `email` varchar(128) NOT NULL,
              `phone` varchar(20) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `INDEX_email_phone` (`email`,`phone`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ');

        return $stmt->execute();
    }
}