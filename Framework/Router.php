<?php

namespace Framework;

class Router
{
    private Request $request;
    public static array $routes = []; //use to be private
    public function __construct(Request $request)
    {
        $this->request = $request;

    }
    private function getCurrentRoute()
    {
        $routes = array_filter(self::$routes,
            fn($route) => $route->getType() == $this->request->getType() && preg_match($route->getMask(), $this->request->getPath()));
        if (!$routes) {
            return null;
        }
//        var_dump($routes);
        usort($routes, fn($route_first, $route_second) => count($this->getParamsForController($route_second)) - count($this->getParamsForController($route_first)));
//        var_dump( $this->getParamsForController($routes[0]));
        return $routes[0];
    }
    private function getParamsForController(Route $route)
    {
        $params = [];
        preg_match_all($route->getMask(), $this->request->getPath(), $params);
//        echo '<br>-----<br>';
//        print_r($params);
//        echo '<br>-----<br>';
//        print_r(array_slice($params, 1));
//        echo '<br>-----<br>';
        return array_map(fn($p) => $p[0], array_slice($params, 1));

    }
    public function getContent()
    {
//        echo ('Маршруты:<br>');
//        var_dump(self::$routes);
        $exec_route = $this->getCurrentRoute();
        $controller_name = $exec_route->getControllerClass();
        $method_name = $exec_route->getControllerMethodName();
        $controller = new $controller_name();
        $params_to_controller = $this->getParamsForController($exec_route);
        return call_user_func_array([$controller, $method_name], $params_to_controller);


    }

    public static function addRoute($route)
    {
        array_push(self::$routes, $route);
    }
}