<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 08.04.2020
 * Time: 02:12
 */

namespace app\models;

use app\components\DB;

class Client extends Model
{
    const TABLE = 'clients';

    public $id;

    public $email;

    public $phone;

    public function validate() : bool
    {
        // TODO: rules
        return true;
    }

    public function save() : bool
    {
        $db = DB::getInstance();
        // Check if exists
        $exist = self::findByEmailAndPhone($this->email, $this->phone);
        if ($exist) {
            $this->id = $exist->id;
        } else {
            $stmt = $db->prepare('INSERT INTO `'.self::TABLE.'` 
              (`email`, `phone`)
              VALUES
              (?, ?);
            ');
            $result = $stmt->execute([$this->email, $this->phone]);
            $this->id = $db->lastInsertId();
            return $result;
        }
        return true;
    }

    public static function findByEmailAndPhone($email, $phone)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT * 
          FROM `'.self::TABLE.'`
          WHERE `email` = ? AND `phone` = ? 
          LIMIT 1;
        ');
        $stmt->execute([$email, $phone]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!empty($data)) {
            $model = new static();
            $model->load($data);
            return $model;
        }
        return NULL;
    }
}