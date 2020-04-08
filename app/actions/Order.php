<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:42
 */

namespace app\actions;

use app\components\Route;
use app\models\Client;
use app\models\Movie;
use app\models\Session;
use app\models\Order as OrderModel;
use app\models\forms\Order as OrderForm;

/**
 * Action for placing a new order for current movie and session
 * @package app\actions
 */
class Order extends Route
{
    /**
     * Count rows in cinema
     */
    const COUNT_ROWS = 5;

    /**
     * Count places in one row
     */
    const COUNT_PLACES = 10;

    /**
     * Main action process
     * @param integer $id
     * @param integer $sid
     */
    public function run($id, $sid) : void
    {
        $model = Movie::findById($id);
        $session = Session::findById($sid);
        $booked = OrderModel::getBookedPlaces($model->id, $session->id);
        $client = new Client();
        $form = NULL;
        // Check hours
        if (date('H') > $session->hours) {
            $session->error = 'Session already finished.';
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($client->load($_POST) && $client->validate() && $client->save()) {
                    $form = new OrderForm($client);
                    $data = [
                        'id_movie' => $model->id,
                        'id_session' => $session->id,
                        'places' => ($_POST['places']) ?? []
                    ];
                    if ($form->load($data) && $form->validate() && $form->saveMultiple()) {
                        setcookie("successBooking", 1, time() + 3, "/");
                        header('Location: '.$_SERVER['REQUEST_URI']);
                        exit;
                    }
                }
            }
        }

        $this->view->load("order", [
            'model' => $model,
            'session' => $session,
            'client' => $client,
            'form' => $form,
            'booked' => $booked,
            'rows' => self::COUNT_ROWS,
            'places' => self::COUNT_PLACES,
            'successBooking' => isset($_COOKIE['successBooking'])
        ]);
    }
}