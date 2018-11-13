<?php


class RequestContext {

    private static $instance;

    /** @var  Router */
    private $router;

    /**
     * RequestContext constructor.
     */
    private function __construct() {
        $this->router = new Router($_SERVER["REQUEST_URI"]);
    }

    /**
     * @return RequestContext singleton instance
     */
    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    /** @return Router */
    public function getRouter(){
        return $this->router;
    }

    public function getParam($name, $default = null) {
        return (isset($_REQUEST[$name]) && !empty($_REQUEST[$name])) ?  $_REQUEST[$name] : $default;
    }

    /**
     * @return bool
     */
    public function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}