<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 20:21
 */

namespace app\models;

use app\components\DB;

class Movie extends Model
{
    const TABLE = 'movies';

    public $id;

    public $title;

    public $description;

    public $poster;

    public $created_at;

    public function validate() : bool
    {
        // TODO: rules
        return true;
    }

    public function save() : bool
    {
        if (!isset($this->id)) {
            $this->created_at = time();
            return $this->insert();
        }
        return $this->update();
    }

    protected function insert() : bool
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('INSERT INTO `'.self::TABLE.'` 
          (`title`, `description`, `poster`, `created_at`)
          VALUES
          (?, ?, ?, ?);
        ');
        return $stmt->execute([$this->title, $this->description, $this->poster, $this->created_at]);
    }

    protected function update() : bool
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('UPDATE `'.self::TABLE.'`
          SET `title` = ?, 
            `description` = ?,
            `poster` = ?
          WHERE `id` = ?;
        ');
        return $stmt->execute([$this->title, $this->description, $this->poster, $this->id]);
    }

    public static function findById($id)
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

    public static function findAll()
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT * 
          FROM `'.self::TABLE.'`
          ORDER BY `created_at` DESC;
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

    public static function deleteById($id)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('DELETE 
          FROM `'.self::TABLE.'`
          WHERE `id` = ?;
        ');
        return $stmt->execute([$id]);
    }

    public static function findPopular($limit = 5)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('
            SELECT `'.self::TABLE.'`.*, count(`'.Order::TABLE.'`.id) as count 
            FROM `'.self::TABLE.'` 
            LEFT JOIN `'.Order::TABLE.'` ON `'.self::TABLE.'`.id = id_movie 
            GROUP BY `'.self::TABLE.'`.id 
            ORDER BY count DESC
            LIMIT '.(int)$limit.';
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