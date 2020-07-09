<?php

namespace vendor\core;
class Router
{
    protected static $routes = [];
    protected static $route = [];

    /**
     * @param $regexp
     * @param array $route
     */

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * @return array
     */

    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * @param string $url
     * @return bool
     */
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)) {
                self::$route = $route;
                //debug($matches);
                foreach ($matches as $k=>$v)
                {
                    if(is_string($k))
                    {
                        $route[$k]=$v;
                    }
                }
                if(!isset($route['action']))
                    $route['action']="index";
                 self::$route =$route;
                 //  debug($route);
                return true;
            }
        }
        return false;
    }

    /**
     * перенаправляет URL по корректному маршруту
     * @param string $url
     * @return void
     */


    public static function dispatch($url)
    {
        if (self::matchRoute($url)) {
            $controller =  'app\controllers\\'.self::upperCamelCase(self::$route['controller']);;

            if(class_exists($controller))
            {
               $cObj = new $controller;
               $action = self::lowerCamelCase(self::$route['action']).'Action';
               if(method_exists($cObj,$action))
               {
                    $cObj->$action();
               }else{
                   echo "Экшен <b>$action</b> не найден";
               }
            }else {
            echo "Контроллер <b>$controller</b> не найден";
            }
        } else {
            http_response_code(404);
            include "404.html";
        }
    }

    /**
     * @param string $name
     * @return string
     */
    protected static function upperCamelCase($name)
    {
        return str_replace(' ','',ucwords(str_replace('-',' ',$name)));
    }

    /**
     * @param string $name
     * @return string
     */
    protected static function lowerCamelCase($name)
    {
        return  lcfirst(self::upperCamelCase($name));
    }

}