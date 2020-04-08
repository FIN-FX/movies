<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 08.04.2020
 * Time: 02:12
 */

namespace app\models;

use app\components\DB;

class Order extends Model
{
    const TABLE = 'orders';

    public $id;

    public $id_movie;

    public $id_client;

    public $id_session;

    public $place;

    public function validate() : bool
    {
        // TODO: rules
        return true;
    }

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

    public static function findByMovieAndSession($idMovie, $idSession)
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

    public static function getBookedPlaces($idMovie, $idSession)
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