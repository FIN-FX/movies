<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 14:36
 */

namespace app\models\forms;

use app\models\Client;
use app\models\Order as Model;
use app\components\DB;

/**
 * Form for ordering places in cinema
 * @package app\models\forms
 */
class Order extends Model
{
    /**
     * @var Client
     */
    public $client;

    /**
     * @var array
     */
    public $places;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return bool
     */
    public function validate() : bool
    {
        if ($this->client->id) {
            $this->id_client = $this->client->id;
        } else {
            $this->error = 'Client not defined. Please try again later.';
            return false;
        }
        if (empty($this->places)) {
            $this->error = 'You must choose your places.';
            return false;
        }
        // Check if booked
        $booked = parent::getBookedPlaces($this->id_movie, $this->id_session);
        foreach ($this->places as $place) {
            $exPlace = explode('_', $place);
            if (isset($booked[$exPlace[0]][$exPlace[1]])) {
                $this->error = 'Places are already booked. Please try again.';
                return false;
            }
        }
        return true;
    }

    /**
     * Saving multiple places for one order
     * @return bool
     */
    public function saveMultiple()
    {
        $db = DB::getInstance();
        $db->beginTransaction();
        foreach ($this->places as $place) {
            $this->place = $place;
            if (!$this->save()) {
                $this->error = 'Please try again later.';
                $db->rollBack();
                return false;
            }
        }
        $db->commit();
        return true;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        parent::validate();
        return parent::save();
    }
}