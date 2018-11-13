<?php

class Env {
    /** @var  String */
    static private $rootDir;

    static public function init() {
        self::$rootDir = $_SERVER['DOCUMENT_ROOT'];
        self::getRequest()->getRouter();
    }

    /**
     * @return RequestContext
     */
    public static function getRequest() {
        return RequestContext::getInstance();
    }
}