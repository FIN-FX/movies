<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:34
 */

namespace app\components;

use app\models\forms\Login as LoginForm;

/**
 * Component for routing requests to actions
 * @package app\components
 */
class Route
{
    /**
     * Shows if user authorized
     * @var bool
     */
    public static $isAdmin = false;

    /**
     * @var View
     */
    protected $view;

    protected $page;

    public function init() : void
    {
        session_start();

        $form = new LoginForm();
        self::$isAdmin = $form->isAuthorized();

        // Load defined URLs
        $data = new Urls();
        $parsed = parse_url($_SERVER['REQUEST_URI']);
        $path = $parsed['path'] ?? '';
        $params = [];
        if (isset($parsed['query'])) {
            parse_str($parsed['query'], $params);
        }
        $key = substr(htmlspecialchars(stripslashes(trim($path))), 1);
        if (array_key_exists($key, $data->data["pages"])) {
            $this->page = $data->data["pages"][$key];
        } else {
            $this->page = $data->data["pages"]["default"];
        }

        $actionName = "app\\actions\\{$this->page}";
        /** @var Route $instance */
        $instance = (new $actionName);
        $instance->view = new View();
        $instance->beforeRun();
        // Call defined action with params
        if (method_exists($instance, 'run')) {
            call_user_func_array([$instance, 'run'], $params);
        }
        $instance->afterRun();
    }

    protected function beforeRun() : void {}

    protected function afterRun() : void {}
}