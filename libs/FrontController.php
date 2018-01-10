<?php

class FrontController {

    static function main() {
        require 'libs/View.php';
        require 'libs/configuration.php';

        if (!empty(filter_input(INPUT_GET, 'controller'))) {
            $controllerName = filter_input(INPUT_GET, 'controller') . 'Controller';
        } else {
            $controllerName = 'IndexController';
        }
        if (!empty(filter_input(INPUT_GET, 'action'))) {
            $actionName = filter_input(INPUT_GET, 'action');
        } else {
            $actionName = 'defaultAction';
        }
        $config = Config::singleton();
        $controllerPath = $config->get('controllerFolder') . $controllerName . '.php';
        if (is_file($controllerPath)) {
            require $controllerPath;
        } else {
            header("Location:?action=notFound");
            return FALSE;
        }
        if (!is_callable(array($controllerName, $actionName))) {
            header("Location:?action=notFound");
            return FALSE;
        }
        $controller = new $controllerName();
        $controller->$actionName();
    }

}
