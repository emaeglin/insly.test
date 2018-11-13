<?php

class Router {
    private $currentRoute = false;

    function __construct($uri) {
        $this->matchRoute($uri);
    }

    public function getParams() {
        if(!empty($_REQUEST)){
            return $_REQUEST;
        }
        return [];
    }

    public function execute() {
        $methodName = $this->currentRoute['method'];
        $class = new $this->currentRoute['controller']();
        if(!method_exists($class, $methodName)) {
            throw new \Exception("Method doesn't exist");
        }
        $class->$methodName();
    }

    private function matchRoute($uri) {
        $map = $this->map();
        $uriR = array_shift(explode("?", $uri));

        $this->currentRoute = isset($map[$uriR]) ? $map[$uriR] : false;
        if (!$this->currentRoute) {
            throw new Exception("Router not Match");
        }
        return true;
    }

    private function map() {
        return [
            '/index.php' =>  [
                'controller'    => CalculatorController::class,
                'method'        => "calc"
            ]
        ];
    }
}