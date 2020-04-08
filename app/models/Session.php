<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 08.04.2020
 * Time: 02:12
 */

namespace app\models;

use app\components\DB;

/**
 * Model for sessions table
 * @package app\models
 */
class Session extends Model
{
    const TABLE = 'sessions';

    public $id;

    public $hours;

    /**
     * @param int $id
     * @return null|static
     */
    public static function findById(int $id)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT * 
          FROM `'.self::TABLE.'`
          WHERE `id` = ? 
          LIMIT 1;
        ');
        $stmt->execute([$id]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!empty($data)) {
            $model = new static();
            $model->load($data);
            return $model;
        }
        return NULL;
    }

    /**
     * @return array
     */
    public static function findAll() : array
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT * 
          FROM `'.self::TABLE.'`
          ORDER BY `hours` ASC;
        ');
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $models = [];
        foreach ($result as $data) {
            if (!empty($data)) {
                $model = new static();
                $model->load($data);
                $models[] = $model;
            }
        }
        return $models;
    }
}