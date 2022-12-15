<?php
namespace App\Core;

class Router {
    public $routes=[
        'GET'=>[],
        'POST' => []
        ];

    public static function load ($file){
        $router = new static;

        require $file;

        return $router;
    } 

    /**
     * @return array[]
     */
    public function get($uri,$controller)
    {
        $this->routes['GET'][$uri]=$controller;
    }
    public function post($uri,$controller)
    {
        $this->routes['POST'][$uri]=$controller;
    }


    /**
     * @throws Exception
     */
    public function direct ($uri, $requestType){
        if (array_key_exists($uri, $this->routes[$requestType])){
            return $this->callAction(
                ...explode('@', $this->routes[$requestType][$uri])
            );

        }

        throw new Exception( 'no routes defined for this url');
    }

    protected function callAction ($controller, $action){
        $controller="App\\Controllers\\{$controller}";
        $controller=new $controller;
        if (! method_exists($controller, $action)){
            throw new Exception( "{$controller} dose not respond to the {$action} action");
        }
        return $controller-> $action();
    }
}