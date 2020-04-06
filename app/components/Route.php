<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:34
 */

namespace app\components;

class Route
{
    public static $isAdmin = false;

    protected $page;

    public function init() : void
    {
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
        $instance->beforeRun();
        if (method_exists($instance, 'run')) {
            call_user_func_array([$instance, 'run'], $params);
        }
        $instance->afterRun();
    }

    protected function beforeRun() : void {}

    protected function afterRun() : void {}
}