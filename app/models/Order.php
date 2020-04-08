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
 * Model for orders table
 * @package app\models
 */
class Order extends Model
{
    const TABLE = 'orders';

    public $id;

    public $id_movie;

    public $id_client;

    public $id_session;

    public $place;

    /**
     * @return bool
     */
    public function validate() : bool
    {
        if (empty($this->id_movie) || !ctype_digit($this->id_movie)) {
            $this->error = 'Undefined movie.';
            return false;
        }
        if (empty($this->id_client) || !ctype_digit($this->id_client)) {
            $this->error = 'Undefined client.';
            return false;
        }
        if (empty($this->id_session) || !ctype_digit($this->id_session)) {
            $this->error = 'Undefined session.';
            return false;
        }
        if (empty($this->place)) {
            $this->error = 'You must choose your places.';
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
        $stmt = $db->prepare('INSERT INTO `'.self::TABLE.'` 
          (`id_movie`, `id_client`, `id_session`, `place`, `created_at`)
          VALUES
          (?, ?, ?, ?, ?);
        ');
        return $stmt->execute([$this->id_movie, $this->id_client, $this->id_session, $this->place, time()]);
    }

    /**
     * @param int $idMovie
     * @param int $idSession
     * @return array
     */
    public static function findByMovieAndSession(int $idMovie, int $idSession) : array
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT * 
          FROM `'.self::TABLE.'`
          WHERE `id_movie` = ? AND `id_session` = ? AND `created_at` > ?;
        ');
        $stmt->execute([$idMovie, $idSession, strtotime('today')]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $models = [];
        foreach ($result as $data) {
            if (!empty($data)) {
                $model = new self();
                $model->load($data);
                $models[] = $model;
            }
        }
        return $models;
    }

    /**
     * @param int $idMovie
     * @param int $idSession
     * @return array
     */
    public static function getBookedPlaces(int $idMovie, int $idSession) : array
    {
        $orders = self::findByMovieAndSession($idMovie, $idSession);
        $booked = [];
        /** @var self $order */
        foreach ($orders as $order) {
            $exPlace = explode('_', $order->place);
            $booked[$exPlace[0]][$exPlace[1]] = 1;
        }
        return $booked;
    }
}