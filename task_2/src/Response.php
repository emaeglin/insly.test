<?php

class Response {
    /**
     * @param $object
     */
    public static function json($object) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($object, JSON_UNESCAPED_UNICODE);
        die;
    }
}