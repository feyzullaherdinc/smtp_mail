<?php

class Router {
    private $routes = [];

    public function add($route, $controller, $method) {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method];
    }

    public function run() {
        $route = $_GET['route'] ?? '/';

        if (isset($this->routes[$route])) {
            $controllerName = $this->routes[$route]['controller'];
            $methodName = $this->routes[$route]['method'];

            require_once __DIR__ . "/../controllers/{$controllerName}.php";
            $controller = new $controllerName();
            $controller->$methodName();
        } else {
            require_once __DIR__ . '/../views/mailForm.php';
        }
    }
}
?>
