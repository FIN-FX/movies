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
 * Model for clients table
 * @package app\models
 */
class Client extends Model
{
    const TABLE = 'clients';

    public $id;

    public $email;

    public $phone;

    /**
     * @return bool
     */
    public function validate() : bool
    {
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Email is invalid.';
            return false;
        }
        $phoneLength = strlen($this->phone);
        if (empty($this->phone) || $phoneLength < 9 || $phoneLength > 20 || !ctype_digit($this->phone)) {
            $this->error = 'Phone is invalid. It must be a decimal string with length from 9 to 20.';
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
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

    /**
     * @param $email
     * @param $phone
     * @return null|static
     */
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