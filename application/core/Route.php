<?php

class Route
{
    function __construct() {

    }

    public static function start()
    {
        $controllerName = 'users';
        $actionName = 'index';
        $actionParametrs = [];

        $routeArray = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routeArray[1])) {
            $controllerName = $routeArray[1];
        }

        if (!empty($routeArray[2])) {
            $actionName = $routeArray[2];
        }

        $modelName = 'md' . $controllerName;


        if (file_exists(PATH.'/application/models/'.$modelName.'.php')) {
            include PATH.'/application/models/'.$modelName.'.php';
        }

        if (file_exists(PATH.'/application/controllers/'.$controllerName.'.php')) {
            include PATH.'/application/controllers/'.$controllerName.'.php';
        } else {
            $view = new BaseView();
            $view->generate('error_404');
            exit;
        }

        $controller = new $controllerName;
        $controller->$actionName();


    }
}