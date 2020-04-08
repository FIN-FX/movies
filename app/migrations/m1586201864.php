<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 22:37
 */

use app\components\DB;

class m1586201864
{
    const TABLE = 'orders';

    public function run()
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('
            CREATE TABLE IF NOT EXISTS `'.self::TABLE.'` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `id_movie` int(11) NOT NULL,
              `id_client` int(11) NOT NULL,
              `id_session` int(11) NOT NULL,
              `place` varchar(10) NOT NULL,
              `created_at` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ');
        return $stmt->execute();
    }
}