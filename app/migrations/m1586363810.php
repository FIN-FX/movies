<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 22:39
 */

use app\components\DB;

class m1586363810
{
    const TABLE = 'sessions';

    public function run()
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('
            LOCK TABLES `sessions` WRITE;
            /*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
            
            INSERT INTO `sessions` (`id`, `hours`)
            VALUES
                (1,10),
                (2,12),
                (3,14),
                (4,16),
                (5,18),
                (6,20);
            
            /*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
            UNLOCK TABLES;
        ');
        return $stmt->execute();
    }
}