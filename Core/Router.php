<?php
namespace Core;
use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router {

    protected $routes = [];


    public function get($uri, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'GET',
            'middleware' => null,
        ];
        return $this;
    }

    public function post($uri, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'POST',
            'middleware' => null,
        ];
        return $this;
    }

    public function delete($uri, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'DELETE',
            'middleware' => null,
        ];
        return $this;
    }

    public function patch($uri, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'PATCH',
            'middleware' => null,
        ];
        return $this;
    }

    public function put($uri, $controller){
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'PUT',
            'middleware' => null,
        ];
        return $this;
    }

    public function only($key){
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    }

    public function route($uri, $method){
        foreach ($this->routes as $route){
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)){
                if($route['middleware']){
                    $middleware = Middleware::MAP[$route['middleware']];
                    (new $middleware)->resolve();
                }
                return require base_path("Http/controllers/" . $route['controller']);
            }
        }
        $this->abort();
    }

    protected function abort($code = 404) {
        http_response_code($code);
    
        require base_path("/views/{$code}.php");
    
        die();
    }

    public function previousURL(){
        return $_SERVER['HTTP_REFERER'];
    }

}