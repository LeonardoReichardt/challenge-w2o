<?php

namespace App\Core;

class Router {

    private array $routes = [];

    public function get(string $path, callable|array $handler): void {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, callable|array $handler): void {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, callable|array $handler): void {
        $this->routes[] = [
            'method' => $method,
            'path'   => $path,
            'handler' => $handler
        ];
    }

    public function dispatch(string $uri, string $method): void  {
        foreach ($this->routes as $route) {
            if($route['path'] === $uri && $route['method'] === $method) {
                $handler = $route['handler'];

                if(is_callable($handler)) {
                    call_user_func($handler);
                } 
                else if(is_array($handler)) {
                    [$controller, $action] = $handler;
                    $controller = "App\\Controllers\\{$controller}";

                    if(class_exists($controller) && method_exists($controller, $action)) {
                        (new $controller)->$action();
                    }
                    else {
                        http_response_code(404);
                        echo "Controller ou método não encontrado.";
                    }
                }

                return;
            }
        }

        http_response_code(404);
        echo "Rota não encontrada.";
    }
    
}