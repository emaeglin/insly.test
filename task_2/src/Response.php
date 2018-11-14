<?php

class Response {
    /**
     * @param $object
     */
    public static function json($object) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($object + ['result'=>'OK'], JSON_UNESCAPED_UNICODE);
        die;
    }
}