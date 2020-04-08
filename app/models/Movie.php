<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 20:21
 */

namespace app\models;

use app\components\DB;

/**
 * Model for movies table
 * @package app\models
 */
class Movie extends Model
{
    const TABLE = 'movies';

    public $id;

    public $title;

    public $description;

    public $poster;

    public $created_at;

    /**
     * @return bool
     */
    public function validate() : bool
    {
        if (empty($this->title) || strlen($this->title) > 100) {
            $this->error = 'Title length must be from 1 to 100 symbols.';
            return false;
        }
        if (empty($this->description) || strlen($this->description) > 255) {
            $this->error = 'Description length must be from 1 to 255 symbols.';
            return false;
        }
        if (empty($this->poster)) {
            $this->error = 'Please select a file to upload.';
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function save() : bool
    {
        if (!isset($this->id)) {
            $this->created_at = time();
            return $this->insert();
        }
        return $this->update();
    }

    /**
     * @return bool
     */
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

    /**
     * @return bool
     */
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

    /**
     * @param $id
     * @return null|static
     */
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

    /**
     * @return array
     */
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

    /**
     * @param $id
     * @return bool
     */
    public static function deleteById($id)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('DELETE 
          FROM `'.self::TABLE.'`
          WHERE `id` = ?;
        ');
        return $stmt->execute([$id]);
    }

    /**
     * Searching for most popular movies
     * @param int $limit
     * @return array
     */
    public static function findPopular(int $limit = 5) : array
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