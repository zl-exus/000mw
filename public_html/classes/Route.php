<?php
namespace classes;  
/*
 * class for routing
 * 
 * 
 */

class Route
{

    public static function buildRoute()
    {
        /* 
         * http://...../
         * http://...../authorization
         * http://...../messages/addmesage
         * http://...../messages/addcomment
         */
        /* default ation and controller */
        $controllerName = "IndexController";
        $modelName = "IndexModel";
        $action = "index";

        /* controller init */
        $route = explode("/", $_SERVER['REQUEST_URI']);

        if ($route[1] != '') {
            $controllerName = ucfirst($route[1] . "Controller");
            $modelName = ucfirst($route[1] . "Model");
        }

        include CONTROLLER_PATH . $controllerName . ".php";
        include MODEL_PATH . $modelName . ".php";

        if (isset($route[2]) && $route[2] != '') {
            $action = $route[2];
        }

        $controller = new controllerName();
        $controller->$action;
    }

    public static function errorPage()
    {
        
    }
}
